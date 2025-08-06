<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FollowFeatureTest extends TestCase
{
    use RefreshDatabase;

    protected User $userA;
    protected User $userB;

    protected function setUp(): void
    {
        parent::setUp();

        // Create two users with UUID ids
        $this->userA = User::factory()->create();
        $this->userB = User::factory()->create();
    }

    public function test_guest_cannot_follow()
    {
        $response = $this->postJson("/api/users/{$this->userB->id}/follow");
        $response->assertStatus(401);
    }

    public function test_user_can_follow_another_user()
    {
        Sanctum::actingAs($this->userA);

        $response = $this->postJson("/api/users/{$this->userB->id}/follow");
        $response->assertStatus(200)
                 ->assertJson(['message' => 'Followed successfully.']);

        $this->assertDatabaseHas('follows', [
            'follower_id' => $this->userA->id,
            'followed_id' => $this->userB->id,
        ]);
    }

    public function test_user_cannot_follow_themselves()
    {
        Sanctum::actingAs($this->userA);

        $response = $this->postJson("/api/users/{$this->userA->id}/follow");
        $response->assertStatus(200); // The service ignores silently

        $this->assertDatabaseMissing('follows', [
            'follower_id' => $this->userA->id,
            'followed_id' => $this->userA->id,
        ]);
    }

    public function test_follow_is_idempotent()
    {
        Sanctum::actingAs($this->userA);

        // First follow
        $this->postJson("/api/users/{$this->userB->id}/follow")->assertStatus(200);

        // Follow again (should not duplicate or error)
        $this->postJson("/api/users/{$this->userB->id}/follow")->assertStatus(200);

        // Assert only one record exists
        $this->assertEquals(1, DB::table('follows')
            ->where('follower_id', $this->userA->id)
            ->where('followed_id', $this->userB->id)
            ->count());
    }

    public function test_user_can_unfollow()
    {
        Sanctum::actingAs($this->userA);

        // First follow
        $this->postJson("/api/users/{$this->userB->id}/follow")->assertStatus(200);

        // Unfollow
        $response = $this->deleteJson("/api/users/{$this->userB->id}/unfollow");
        $response->assertStatus(200)
                 ->assertJson(['message' => 'Unfollowed successfully.']);

        $this->assertDatabaseMissing('follows', [
            'follower_id' => $this->userA->id,
            'followed_id' => $this->userB->id,
        ]);
    }

    public function test_can_get_followers_list()
    {
        // userB follows userA
        DB::table('follows')->insert([
            'follower_id' => $this->userB->id,
            'followed_id' => $this->userA->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Sanctum::actingAs($this->userA);

        $response = $this->getJson("/api/users/{$this->userA->id}/followers");
        $response->assertStatus(200);
        $response->assertJsonStructure(['data' => [['id', 'username', 'name']]]);
        $this->assertEquals($this->userB->id, $response->json('data.0.id'));
    }

    public function test_can_get_following_list()
    {
        // userA follows userB
        DB::table('follows')->insert([
            'follower_id' => $this->userA->id,
            'followed_id' => $this->userB->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Sanctum::actingAs($this->userA);

        $response = $this->getJson("/api/users/{$this->userA->id}/following");
        $response->assertStatus(200);
        $response->assertJsonStructure(['data' => [['id', 'username', 'name']]]);
        $this->assertEquals($this->userB->id, $response->json('data.0.id'));
    }
}

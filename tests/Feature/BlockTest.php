<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Block;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;

class BlockTest extends TestCase
{
    use RefreshDatabase;

    protected function authenticate(User $user = null): User
    {
        $user = $user ?? User::factory()->create();
        $this->actingAs($user, 'sanctum');
        return $user;
    }

    public function test_user_can_block_another_user()
    {
        $blocker = $this->authenticate();
        $target = User::factory()->create();

        $response = $this->postJson("/api/users/{$target->id}/block");

        $response->assertStatus(Response::HTTP_CREATED)
                 ->assertJson(['message' => 'User blocked.']);

        $this->assertDatabaseHas('blocks', [
            'blocker_id' => $blocker->id,
            'blocked_id' => $target->id,
        ]);
    }

    public function test_user_cannot_block_themselves()
    {
        $user = $this->authenticate();

        $response = $this->postJson("/api/users/{$user->id}/block");

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
                 ->assertJson(['message' => 'You cannot block yourself.']);

        $this->assertDatabaseMissing('blocks', [
            'blocker_id' => $user->id,
            'blocked_id' => $user->id,
        ]);
    }

    public function test_user_cannot_block_same_user_twice()
    {
        $this->authenticate();
        $target = User::factory()->create();

        // Block once
        $this->postJson("/api/users/{$target->id}/block");

        // Attempt to block again
        $response = $this->postJson("/api/users/{$target->id}/block");

        $response->assertStatus(Response::HTTP_OK)
                 ->assertJson(['message' => 'User already blocked.']);
    }

    public function test_user_can_unblock_a_blocked_user()
    {
        $blocker = $this->authenticate();
        $target = User::factory()->create();

        Block::create([
            'blocker_id' => $blocker->id,
            'blocked_id' => $target->id,
        ]);

        $response = $this->deleteJson("/api/users/{$target->id}/block");

        $response->assertStatus(Response::HTTP_OK)
                 ->assertJson(['message' => 'User unblocked.']);

        $this->assertDatabaseMissing('blocks', [
            'blocker_id' => $blocker->id,
            'blocked_id' => $target->id,
        ]);
    }

    public function test_unblocking_user_that_was_not_blocked_returns_proper_message()
    {
        $this->authenticate();
        $target = User::factory()->create();

        $response = $this->deleteJson("/api/users/{$target->id}/block");

        $response->assertStatus(Response::HTTP_OK)
                 ->assertJson(['message' => 'User was not blocked.']);
    }

    public function test_user_can_see_their_blocked_users()
    {
        $blocker = $this->authenticate();
        $blockedUsers = User::factory()->count(3)->create();
        foreach ($blockedUsers as $blocked) {
            Block::create([
                'blocker_id' => $blocker->id,
                'blocked_id' => $blocked->id,
            ]);
        }

        $response = $this->getJson('/api/users/blocked');

        $response->assertOk()
                 ->assertJsonCount(3, 'data');
    }
}

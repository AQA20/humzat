<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Post;
use App\Models\Vote;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostVoteTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;
    protected Post $post;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->post = Post::factory()->create();
    }

    public function test_user_can_upvote_a_post(): void
    {
        $this->actingAs($this->user);

        $response = $this->postJson("/api/vote", [
            'votable_type' => 'post',
            'votable_id' => $this->post->id,
            'is_upvote' => true,
        ]);
        $response->assertOk();
        $this->assertDatabaseHas('votes', [
            'user_id' => $this->user->id,
            'votable_id' => $this->post->id,
            'votable_type' => Post::class,
            'is_upvote' => true,
        ]);
    }

    public function test_user_can_downvote_a_post(): void
    {
        $this->actingAs($this->user);

        $response = $this->postJson("/api/vote", [
            'votable_type' => 'post',
            'votable_id' => $this->post->id,
            'is_upvote' => false,
        ]);

        $response->assertOk();
        $this->assertDatabaseHas('votes', [
            'user_id' => $this->user->id,
            'votable_id' => $this->post->id,
            'votable_type' => Post::class,
            'is_upvote' => false,
        ]);
    }

    public function test_user_can_toggle_vote_off_by_voting_same_again(): void
    {
        $this->actingAs($this->user);

        // First upvote
        $this->postJson("/api/vote", [
            'votable_type' => 'post',
            'votable_id' => $this->post->id,
            'is_upvote' => true,
        ]);

        // Same upvote again = toggle off
        $this->postJson("/api/vote", [
            'votable_type' => 'post',
            'votable_id' => $this->post->id,
            'is_upvote' => true,
        ]);

        $this->assertDatabaseMissing('votes', [
            'user_id' => $this->user->id,
            'votable_id' => $this->post->id,
        ]);
    }

    public function test_user_can_change_vote_direction(): void
    {
        $this->actingAs($this->user);

        // First upvote
        $this->postJson("/api/vote", [
            'votable_type' => 'post',
            'votable_id' => $this->post->id,
            'is_upvote' => true,
        ]);

        // Change to downvote
        $this->postJson("/api/vote", [
            'votable_type' => 'post',
            'votable_id' => $this->post->id,
            'is_upvote' => false,
        ]);

        $this->assertDatabaseHas('votes', [
            'user_id' => $this->user->id,
            'votable_id' => $this->post->id,
            'is_upvote' => false,
        ]);

        $this->assertDatabaseCount('votes', 1); // still only one vote
    }

    public function test_only_one_vote_record_per_user_post(): void
    {
        $this->actingAs($this->user);

        $this->postJson("/api/vote", [
            'votable_type' => 'post',
            'votable_id' => $this->post->id,
            'is_upvote' => true
        ]);
        $this->postJson("/api/vote", [
            'votable_type' => 'post',
            'votable_id' => $this->post->id,
            'is_upvote' => false
        ]);

        $this->assertEquals(1, Vote::where('user_id', $this->user->id)
            ->where('votable_id', $this->post->id)->count());
    }
}

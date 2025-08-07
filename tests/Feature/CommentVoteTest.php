<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommentVoteTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    public function test_user_can_upvote_a_post()
    {
        $post = Post::factory()->create();

        $response = $this->actingAs($this->user)->postJson('/api/vote', [
            'votable_type' => 'post',
            'votable_id' => $post->id,
            'is_upvote' => true,
        ]);

        $response->assertOk();
        $this->assertDatabaseHas('votes', [
            'votable_type' => Post::class,
            'votable_id' => $post->id,
            'user_id' => $this->user->id,
            'is_upvote' => true,
        ]);
    }

    public function test_user_can_downvote_a_comment()
    {
        $comment = Comment::factory()->create();

        $response = $this->actingAs($this->user)->postJson('/api/vote', [
            'votable_type' => 'comment',
            'votable_id' => $comment->id,
            'is_upvote' => false,
        ]);

        $response->assertOk();
        $this->assertDatabaseHas('votes', [
            'votable_type' => Comment::class,
            'votable_id' => $comment->id,
            'user_id' => $this->user->id,
            'is_upvote' => false,
        ]);
    }

    public function test_vote_requires_authentication()
    {
        $post = Post::factory()->create();

        $response = $this->postJson('/api/vote', [
            'votable_type' => 'post',
            'votable_id' => $post->id,
            'is_upvote' => true,
        ]);

        $response->assertUnauthorized();
    }

    public function test_vote_fails_with_invalid_votable_type()
    {
        $response = $this->actingAs($this->user)->postJson('/api/vote', [
            'votable_type' => 'invalid_type',
            'votable_id' => 1,
            'is_upvote' => true,
        ]);

        $response->assertUnprocessable();
    }

    public function test_vote_validation_errors()
    {
        $response = $this->actingAs($this->user)->postJson('/api/vote', []);

        $response->assertUnprocessable()
            ->assertJsonValidationErrors(['votable_type', 'votable_id', 'is_upvote']);
    }

    public function test_user_can_toggle_vote_to_remove_it()
    {
        $post = Post::factory()->create();

        // First vote
        $this->actingAs($this->user)->postJson('/api/vote', [
            'votable_type' => 'post',
            'votable_id' => $post->id,
            'is_upvote' => true,
        ]);

        // Vote again with same value (should remove vote)
        $this->actingAs($this->user)->postJson('/api/vote', [
            'votable_type' => 'post',
            'votable_id' => $post->id,
            'is_upvote' => true,
        ]);

        $this->assertDatabaseMissing('votes', [
            'votable_type' => Post::class,
            'votable_id' => $post->id,
            'user_id' => $this->user->id,
        ]);
    }

    public function test_user_can_switch_vote_type()
    {
        $post = Post::factory()->create();

        // Upvote first
        $this->actingAs($this->user)->postJson('/api/vote', [
            'votable_type' => 'post',
            'votable_id' => $post->id,
            'is_upvote' => true,
        ]);

        // Then downvote
        $this->actingAs($this->user)->postJson('/api/vote', [
            'votable_type' => 'post',
            'votable_id' => $post->id,
            'is_upvote' => false,
        ]);

        $this->assertDatabaseHas('votes', [
            'votable_type' => Post::class,
            'votable_id' => $post->id,
            'user_id' => $this->user->id,
            'is_upvote' => false,
        ]);
    }
}

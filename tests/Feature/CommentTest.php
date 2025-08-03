<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;
    protected Post $post;

    protected function setUp(): void
    {
        parent::setUp();

        // Create a user and a post to work with
        $this->user = User::factory()->create();
        $this->post = Post::factory()->create();
    }

    public function test_guests_cannot_access_protected_comment_routes()
    {
        $comment = Comment::factory()->create();

        $this->json('POST', '/api/comments')->assertStatus(401);
        $this->json('PUT', "/api/comments/{$comment->id}")->assertStatus(401);
        $this->json('DELETE', "/api/comments/{$comment->id}")->assertStatus(401);
    }

    public function test_anyone_can_list_comments_with_pagination()
    {
        Comment::factory()->count(15)->create(['post_id' => $this->post->id, 'parent_id' => null]);

        $response = $this->json('GET', '/api/comments');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [['id', 'body', 'user', 'replies', 'parent_id', 'created_at']],
                'links',
                'meta',
            ]);
    }

    public function test_anyone_can_view_a_single_comment()
    {
        $comment = Comment::factory()->create(['post_id' => $this->post->id]);

        $response = $this->json('GET', "/api/comments/{$comment->id}");

        $response->assertStatus(200)
            ->assertJsonPath('data.id', $comment->id);
    }

    public function test_show_non_existent_comment_returns_404()
    {
        $nonExistentId = '00000000-0000-0000-0000-000000000000';

        $this->json('GET', "/api/comments/{$nonExistentId}")
            ->assertStatus(404);
    }

    public function test_authenticated_user_can_create_comment()
    {
        $payload = [
            'body' => 'This is a test comment.',
            'post_id' => $this->post->id,
            'parent_id' => null,
        ];

        $response = $this->actingAs($this->user, 'sanctum')
            ->json('POST', '/api/comments', $payload);

        $response->assertStatus(201)
            ->assertJsonFragment(['body' => 'This is a test comment.'])
            ->assertJsonPath('data.user.id', $this->user->id);

        $this->assertDatabaseHas('comments', [
            'body' => 'This is a test comment.',
            'user_id' => $this->user->id,
            'post_id' => $this->post->id,
            'parent_id' => null,
        ]);
    }

    public function test_create_comment_validation_errors()
    {
        $this->actingAs($this->user, 'sanctum')
            ->json('POST', '/api/comments', [])
            ->assertStatus(422)
            ->assertJsonValidationErrors(['body', 'post_id']);
    }

    public function test_authenticated_user_can_update_their_own_comment()
    {
        $comment = Comment::factory()->create([
            'user_id' => $this->user->id,
            'post_id' => $this->post->id,
            'body' => 'Original comment',
        ]);

        $payload = ['body' => 'Updated comment'];

        $response = $this->actingAs($this->user, 'sanctum')
            ->json('PUT', "/api/comments/{$comment->id}", $payload);

        $response->assertStatus(200)
            ->assertJsonFragment(['body' => 'Updated comment']);

        $this->assertDatabaseHas('comments', [
            'id' => $comment->id,
            'body' => 'Updated comment',
        ]);
    }

    public function test_user_cannot_update_others_comments()
    {
        $otherUser = User::factory()->create();
        $comment = Comment::factory()->create([
            'user_id' => $otherUser->id,
            'post_id' => $this->post->id,
            'body' => 'Original comment',
        ]);

        $payload = ['body' => 'Malicious update'];

        $this->actingAs($this->user, 'sanctum')
            ->json('PUT', "/api/comments/{$comment->id}", $payload)
            ->assertStatus(403);
    }

    public function test_update_comment_requires_body()
    {
        $comment = Comment::factory()->create(['user_id' => $this->user->id]);

        $this->actingAs($this->user, 'sanctum')
            ->json('PUT', "/api/comments/{$comment->id}", ['body' => ''])
            ->assertStatus(422)
            ->assertJsonValidationErrors(['body']);
    }

    public function test_authenticated_user_can_delete_their_own_comment()
    {
        $comment = Comment::factory()->create(['user_id' => $this->user->id]);

        $this->actingAs($this->user, 'sanctum')
            ->json('DELETE', "/api/comments/{$comment->id}")
            ->assertStatus(200)
            ->assertJson(['message' => 'Comment deleted successfully']);

        $this->assertDatabaseMissing('comments', ['id' => $comment->id]);
    }

    public function test_user_cannot_delete_others_comments()
    {
        $otherUser = User::factory()->create();
        $comment = Comment::factory()->create(['user_id' => $otherUser->id]);

        $this->actingAs($this->user, 'sanctum')
            ->json('DELETE', "/api/comments/{$comment->id}")
            ->assertStatus(403);
    }

    public function test_deleting_non_existent_comment_returns_404()
    {
        $nonExistentId = '00000000-0000-0000-0000-000000000000';

        $this->actingAs($this->user, 'sanctum')
            ->json('DELETE', "/api/comments/{$nonExistentId}")
            ->assertStatus(404);
    }
}

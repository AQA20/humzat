<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SavedPostsTest extends TestCase
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

    public function test_guest_cannot_access_saved_posts_endpoints()
    {
        $this->getJson('/api/saved-posts')->assertStatus(401);
        $this->postJson("/api/posts/{$this->post->id}/save")->assertStatus(401);
        $this->deleteJson("/api/posts/{$this->post->id}/unsave")->assertStatus(401);
    }

    public function test_user_can_save_a_post()
    {
        $response = $this->actingAs($this->user)
            ->postJson("/api/posts/{$this->post->id}/save");

        $response->assertStatus(200)
                 ->assertJson(['message' => 'Post saved successfully.']);

        $this->assertDatabaseHas('post_user_saves', [
            'user_id' => $this->user->id,
            'post_id' => $this->post->id,
        ]);
    }

    public function test_saving_the_same_post_twice_does_not_duplicate()
    {
        $this->actingAs($this->user)
             ->postJson("/api/posts/{$this->post->id}/save")
             ->assertStatus(200);

        // Save again
        $this->actingAs($this->user)
             ->postJson("/api/posts/{$this->post->id}/save")
             ->assertStatus(200);

        $count = DB::table('post_user_saves')
            ->where('user_id', $this->user->id)
            ->where('post_id', $this->post->id)
            ->count();

        $this->assertEquals(1, $count, "Post should only be saved once");
    }

    public function test_user_can_unsave_a_post()
    {
        // First save it
        $this->actingAs($this->user)
            ->postJson("/api/posts/{$this->post->id}/save");

        // Then unsave it
        $response = $this->actingAs($this->user)
            ->deleteJson("/api/posts/{$this->post->id}/unsave");

        $response->assertStatus(200)
                 ->assertJson(['message' => 'Post unsaved successfully.']);

        $this->assertDatabaseMissing('post_user_saves', [
            'user_id' => $this->user->id,
            'post_id' => $this->post->id,
        ]);
    }

    public function test_unsaving_a_post_not_saved_does_not_error()
    {
        $response = $this->actingAs($this->user)
            ->deleteJson("/api/posts/{$this->post->id}/unsave");

        $response->assertStatus(200)
                 ->assertJson(['message' => 'Post unsaved successfully.']);
    }

    public function test_user_can_list_saved_posts()
    {
        // Save multiple posts
        $posts = Post::factory()->count(3)->create();

        foreach ($posts as $post) {
            $this->actingAs($this->user)
                 ->postJson("/api/posts/{$post->id}/save");
        }

        $response = $this->actingAs($this->user)
            ->getJson('/api/saved-posts');

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data' => [
                         ['id', 'user_id', 'body', "external_url", "type", "meta"]
                     ],
                     'links',
                     'meta',
                 ]);

        $this->assertCount(3, $response->json('data'));
    }
}

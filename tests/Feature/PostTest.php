<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use App\Enums\PostType;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;
    protected User $otherUser;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->otherUser = User::factory()->create();
        Storage::fake('public');
    }

    // Guests can access index and show (read-only)
    public function test_guests_can_access_index_and_show()
    {
        $post = Post::factory()->create();

        $this->json('GET', '/api/posts')
            ->assertStatus(Response::HTTP_OK);

        $this->json('GET', "/api/posts/{$post->id}")
            ->assertStatus(Response::HTTP_OK);
    }

    // Guests cannot create, update or delete posts
    public function test_guests_cannot_store_update_or_delete_posts()
    {
        $post = Post::factory()->create();

        $this->json('POST', '/api/posts', [
            'body' => 'Guest attempt',
            'external_url' => 'https://example.com',
        ])->assertStatus(Response::HTTP_UNAUTHORIZED);

        $this->json('PUT', "/api/posts/{$post->id}", [
            'body' => 'Update attempt',
        ])->assertStatus(Response::HTTP_UNAUTHORIZED);

        $this->json('DELETE', "/api/posts/{$post->id}")
            ->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    public function test_user_can_list_posts_paginated()
    {
        Post::factory()->count(15)->create();

        $response = $this->actingAs($this->user, 'sanctum')->json('GET', '/api/posts');

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data',
                'links',
                'meta',
            ]);

        $this->assertCount(10, $response->json('data'));
    }

    public function test_user_can_create_post_with_valid_data_and_external_url()
    {
        $payload = [
            'body' => 'Test body content',
            'external_url' => 'https://example.com/video/123',
            'meta' => ['tags' => ['tag1', 'tag2'], 'domain' => 'example.com'],
            'type' => PostType::VIDEO->value
        ];

        $response = $this->actingAs($this->user, 'sanctum')->json('POST', '/api/posts', $payload);

        $response->assertStatus(Response::HTTP_CREATED)
            ->assertJsonFragment(['body' => 'Test body content', 'external_url' => 'https://example.com/video/123'])
            ->assertJsonFragment(['meta' => ['tags' => ['tag1', 'tag2']]]) // check hashtags
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'user_id',
                    'body',
                    'external_url',
                    'meta',
                ]
            ]);

        $this->assertDatabaseHas('posts', [
            'body' => 'Test body content',
            'external_url' => 'https://example.com/video/123',
            'user_id' => $this->user->id,
            'type' => PostType::VIDEO->value,
        ]);

        $this->assertDatabaseHas('hashtags', ['name' => 'tag1']);
        $this->assertDatabaseHas('hashtags', ['name' => 'tag2']);

        $postId = $response->json('data.id');
        $post = Post::find($postId);
        $this->assertCount(2, $post->hashtags);
    }

    public function test_create_post_requires_body()
    {
        $payload = ['external_url' => 'https://example.com'];

        $response = $this->actingAs($this->user, 'sanctum')->json('POST', '/api/posts', $payload);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonValidationErrors(['body']);
    }

    public function test_user_can_view_a_single_post()
    {
        $post = Post::factory()->create([
            'body' => 'Sample post body',
            'external_url' => 'https://example.com',
        ]);

        $response = $this->actingAs($this->user, 'sanctum')->json('GET', "/api/posts/{$post->id}");

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonFragment([
                'id' => $post->id,
                'body' => 'Sample post body',
                'external_url' => 'https://example.com',
            ]);
    }

    public function test_user_can_update_own_post()
    {
        $post = Post::factory()->for($this->user)->create([
            'body' => 'Old body',
            'external_url' => 'https://old-url.com',
        ]);

        $payload = [
            'body' => 'Updated body',
            'external_url' => 'https://updated-url.com',
        ];

        $response = $this->actingAs($this->user, 'sanctum')->json('PUT', "/api/posts/{$post->id}", $payload);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonFragment(['body' => 'Updated body', 'external_url' => 'https://updated-url.com']);

        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
            'body' => 'Updated body',
            'external_url' => 'https://updated-url.com',
        ]);
    }

    public function test_user_cannot_update_others_post()
    {
        $post = Post::factory()->for($this->otherUser)->create([
            'body' => 'Other user post body',
        ]);

        $payload = ['body' => 'Hack Update'];

        $response = $this->actingAs($this->user, 'sanctum')->json('PUT', "/api/posts/{$post->id}", $payload);

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function test_update_post_validation_works()
    {
        $post = Post::factory()->for($this->user)->create();

        $payload = ['body' => '']; // body cannot be empty if present

        $response = $this->actingAs($this->user, 'sanctum')->json('PUT', "/api/posts/{$post->id}", $payload);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonValidationErrors(['body']);
    }

    public function test_user_can_delete_own_post()
    {
        $post = Post::factory()->for($this->user)->create();

        $response = $this->actingAs($this->user, 'sanctum')->json('DELETE', "/api/posts/{$post->id}");

        $response->assertStatus(Response::HTTP_OK);

        $this->assertDatabaseMissing('posts', ['id' => $post->id]);
    }

    public function test_user_cannot_delete_others_post()
    {
        $post = Post::factory()->for($this->otherUser)->create();

        $response = $this->actingAs($this->user, 'sanctum')->json('DELETE', "/api/posts/{$post->id}");

        $response->assertStatus(Response::HTTP_FORBIDDEN);

        $this->assertDatabaseHas('posts', ['id' => $post->id]);
    }

    public function test_user_can_update_post_and_sync_hashtags()
    {
        $post = Post::factory()->for($this->user)->create();

        $payload = [
            'body' => 'Updated with tags',
            'meta' => ['tags' => ['update1', 'update2']],
        ];

        $response = $this->actingAs($this->user, 'sanctum')->json('PUT', "/api/posts/{$post->id}", $payload);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonFragment(['body' => 'Updated with tags']);

        $this->assertEqualsCanonicalizing(
            ['update1', 'update2'],
            $response->json('data.meta.tags')
        );

        $this->assertDatabaseHas('hashtags', ['name' => 'update1']);
        $this->assertDatabaseHas('hashtags', ['name' => 'update2']);

        $this->assertCount(2, $post->fresh()->hashtags);
    }

    public function test_updating_post_with_empty_tags_removes_existing_hashtags()
    {
        $post = Post::factory()->for($this->user)->create();
        $post->hashtags()->createMany([
            ['id' => \Illuminate\Support\Str::uuid(), 'name' => 'keepme'],
            ['id' => \Illuminate\Support\Str::uuid(), 'name' => 'remove'],
        ]);

        $this->assertCount(2, $post->hashtags);

        $payload = [
            'meta' => ['tags' => []], // Remove all
        ];

        $response = $this->actingAs($this->user, 'sanctum')->json('PUT', "/api/posts/{$post->id}", $payload);
        $response->assertStatus(Response::HTTP_OK);

        $this->assertCount(0, $post->fresh()->hashtags);
    }
}

<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Post;
use App\Models\Hashtag;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HashtagTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that the index endpoint returns a list of hashtags.
     */
    public function test_index_returns_paginated_hashtags()
    {
        $hashtags = Hashtag::factory()->count(5)->create();

        $response = $this->getJson('/api/hashtags');
        $response->assertOk()
            ->assertJsonStructure([
                'data' => [
                    '*' => ['id', 'name', 'posts_count', 'created_at', 'updated_at'],
                ],
                'meta' => [
                    'current_page',
                    'last_page',
                    'per_page',
                    'total',
                ],
                'links' => [
                    'first',
                    'last',
                    'prev',
                    'next',
                ],
            ])
            ->assertJsonFragment([
                'name' => $hashtags->first()->name,
            ]);
    }

    /**
     * Test that the show endpoint returns a hashtag and its related posts.
     */
    public function test_show_returns_hashtag_with_related_posts()
    {
        $hashtag = Hashtag::factory()->create();

        Post::factory()
            ->count(3)
            ->hasAttached($hashtag)
            ->create();

        $response = $this->getJson("/api/hashtags/{$hashtag->id}");

        $response->assertOk()
            ->assertJsonStructure([
                'hashtag' => ['id', 'name', 'created_at', 'updated_at'],
                'posts' => [
                    'data' => [
                        '*' => ['id', 'body', 'user', 'hashtags', 'media', 'created_at', 'updated_at'],
                    ],
                    'meta' => [
                        'current_page',
                        'last_page',
                        'per_page',
                        'total',
                    ],
                    'links' => [
                        'first',
                        'last',
                        'prev',
                        'next',
                    ],
                ],
            ])
            ->assertJsonFragment([
                'name' => $hashtag->name,
            ]);
    }

    public function test_show_by_name_returns_hashtag_with_related_posts()
    {
        $hashtag = Hashtag::factory()->create();

        Post::factory()
            ->count(3)
            ->hasAttached($hashtag)
            ->create();

        $response = $this->getJson("/api/hashtags/by-name/{$hashtag->name}");
        $response->assertOk()
            ->assertJsonStructure([
                'hashtag' => ['id', 'name', 'created_at', 'updated_at'],
                'posts' => [
                    'data' => [
                        '*' => ['id', 'body', 'user', 'hashtags', 'media', 'created_at', 'updated_at'],
                    ],
                    'meta' => ['current_page', 'last_page', 'per_page', 'total'],
                    'links' => ['first', 'last', 'prev', 'next'],
                ],
            ])
            ->assertJsonFragment(['name' => $hashtag->name]);
    }
}

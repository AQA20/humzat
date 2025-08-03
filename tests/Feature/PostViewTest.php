<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Str;
use App\Models\Post;
use Illuminate\Support\Facades\Event;
use App\Events\PostViewed;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostViewTest extends TestCase
{
    use RefreshDatabase;

    // Test that the PostViewed event is dispatched properly
    public function test_post_view_event_is_dispatched()
    {
        Event::fake();

        $post = Post::factory()->create();

        $this->withHeader('X-Client-UUID', (string) Str::uuid())
            ->withServerVariables(['REMOTE_ADDR' => '123.123.123.123'])
            ->getJson(route('posts.show', $post->id))
            ->assertOk();

        Event::assertDispatched(PostViewed::class, fn($event) => $event->post->id === $post->id);
    }

    // Test that viewing a post records a unique post_view record
    public function test_post_view_creates_unique_record()
    {
        // No event fake here: listeners run normally
        $post = Post::factory()->create();

        $uuid = (string) Str::uuid();
        $ip = '123.123.123.123';

        $this->withHeader('X-Client-UUID', $uuid)
            ->withServerVariables(['REMOTE_ADDR' => $ip])
            ->getJson(route('posts.show', $post->id))
            ->assertOk();

        // Second identical request
        $this->withHeader('X-Client-UUID', $uuid)
            ->withServerVariables(['REMOTE_ADDR' => $ip])
            ->getJson(route('posts.show', $post->id))
            ->assertOk();

        // Assert exactly one record was created
        $this->assertDatabaseCount('post_views', 1);

        $this->assertDatabaseHas('post_views', [
            'post_id' => $post->id,
            'ip_address' => $ip,
            'uuid' => $uuid,
        ]);
    }
}

<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Str;
use App\Models\Post;
use Illuminate\Support\Facades\Event;
use App\Events\PostShared;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostShareTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that the PostShared event is dispatched properly
     */
    public function test_post_share_event_is_dispatched(): void
    {
        Event::fake();

        $post = Post::factory()->create();
        $this->withHeader('X-Client-UUID', (string) Str::uuid())
            ->withServerVariables(['REMOTE_ADDR' => '123.123.123.123'])
            ->postJson("/api/posts/{$post->id}/share")
            ->assertOk();
        Event::assertDispatched(PostShared::class, fn ($event) => $event->post->id === $post->id);
    }

    /**
     * Test that sharing a post creates a unique post_share record
     */
    public function test_post_share_creates_unique_record(): void
    {
        $post = Post::factory()->create();
        $uuid = (string) Str::uuid();
        $ip = '123.123.123.123';

        // First share
        $this->withHeader('X-Client-UUID', $uuid)
            ->withServerVariables(['REMOTE_ADDR' => $ip])
            ->postJson("/api/posts/{$post->id}/share")
            ->assertOk();

        // Duplicate share - should not create another record
        $this->withHeader('X-Client-UUID', $uuid)
            ->withServerVariables(['REMOTE_ADDR' => $ip])
            ->postJson("/api/posts/{$post->id}/share")
            ->assertOk();

        // Assert only one record exists
        $this->assertDatabaseCount('post_shares', 1);

        $this->assertDatabaseHas('post_shares', [
            'post_id' => $post->id,
            'ip_address' => $ip,
            'uuid' => $uuid,
        ]);
    }
}

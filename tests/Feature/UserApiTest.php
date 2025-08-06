<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Post;
use App\Models\User;
use App\Models\Block;
use App\Models\Media;
use App\Models\Comment;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_returns_public_user_profile()
    {
        $user = User::factory()->create();

        $response = $this->getJson("/api/users/{$user->id}");
        $response->assertOk()
            ->assertJsonFragment([
                'id'       => $user->id,
                'username' => $user->username,
                'name'     => $user->name,
                'bio'      => $user->bio,
                'profile_picture_url' => null,
                'followers_count' => 0,
                'following_count' => 0,
            ])
            ->assertJsonMissing(['email']);
    }

    public function test_it_returns_users_posts_with_media_and_comments()
    {
        $user = User::factory()->create();
        $post = Post::factory()->for($user)->create();
        $media = Media::factory()->for($post)->create();
        $comment = Comment::factory()->for($user)->for($post)->create();

        $response = $this->getJson("/api/users/{$user->id}/posts");

        $response->assertOk()
            ->assertJsonFragment(['id' => $post->id])
            ->assertJsonFragment(['id' => $media->id])
            ->assertJsonFragment(['id' => $comment->id]);
    }

    public function test_it_returns_users_comments()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create();
        $comment = Comment::factory()->for($user)->for($post)->create();

        $response = $this->getJson("/api/users/{$user->id}/comments");

        $response->assertOk()
            ->assertJsonFragment(['id' => $comment->id]);
    }


    public function test_blocked_user_cannot_access_profile_or_related_data()
    {
        $userA = User::factory()->create();
        $userB = User::factory()->create();

        Block::factory()->create([
            'blocker_id' => $userA->id,
            'blocked_id' => $userB->id,
        ]);

        $this->actingAs($userB);

        $this->getJson("/api/users/{$userA->id}")->assertForbidden();
        $this->getJson("/api/users/{$userA->id}/posts")->assertForbidden();
        $this->getJson("/api/users/{$userA->id}/comments")->assertForbidden();
    }


    public function test_user_can_upload_and_view_profile_picture()
    {
        // Use real s3 disk
        $disk = Storage::disk('s3');

        $user = User::factory()->create();
        $this->actingAs($user);

        // Create fake image file
        $file = UploadedFile::fake()->image('profile.jpg', 300, 300)->size(1024);

        // Upload it
        $response = $this->postJson('/api/users/profile-picture', [
            'image' => $file,
        ]);

        $response->assertOk();
        $url = $response->json('url');

        $this->assertNotEmpty($url, 'Signed URL should be returned');

        // Extract file key from the URL
        $filename = parse_url($url, PHP_URL_PATH);
        $filename = Str::after($filename, '/'); // remove leading slash

        // Assert file actually exists in S3
        $this->assertTrue($disk->exists($filename), "File does not exist in S3: {$filename}");

        // download and check mime or contents
        $this->assertStringContainsString('profile_pictures/', $filename);

        // Cleanup: delete the file manually
        $disk->delete($filename);
        $this->assertFalse($disk->exists($filename), "File was not deleted from S3");
    }
}

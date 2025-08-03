<?php

namespace Tests\Feature\Services;

use Tests\TestCase;
use App\Models\Post;
use App\Models\Media;
use App\Enums\MediaType;
use Illuminate\Support\Str;
use App\Services\MediaService;
use Illuminate\Http\UploadedFile;
use App\Services\CloudFrontUrlSigner;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;

class MediaServiceTest extends TestCase
{
    use RefreshDatabase;

    protected MediaService $mediaService;
    protected CloudFrontUrlSigner $cloudFrontSigner;

    protected function setUp(): void
    {
        parent::setUp();

        // Create mock
        $this->cloudFrontSigner = Mockery::mock(CloudFrontUrlSigner::class);

        // Bind mock to container so it's injected into MediaService
        $this->app->instance(CloudFrontUrlSigner::class, $this->cloudFrontSigner);

        // Now when we resolve MediaService, it gets the mock injected
        $this->mediaService = app(MediaService::class);
    }


    public function test_upload_image_to_s3_and_returns_signed_url_and_name()
    {
        // Given
        $file = UploadedFile::fake()->image('test.jpg');

        // And CloudFront signer is mocked
        $this->cloudFrontSigner
            ->shouldReceive('getSignedUrl')
            ->once()
            ->andReturn(config('services.cloudfront.domain') . '/media/images/test.jpg');

        // When
        $result = $this->mediaService->uploadImage($file, 'media/images');

        // Then
        $this->assertTrue(Storage::disk('s3')->exists($result['name']), 'File not found on S3');

        $this->assertStringContainsString(config('services.cloudfront.domain'), $result['url']);
        $this->assertStringContainsString('media/images/', $result['name']);

        // Clean up
        $this->mediaService->deleteFile($result['name']);
    }

    public function test_create_media_record_for_post()
    {
        $post = Post::factory()->create();

        $uploadData = [
            'url' => config('services.cloudfront.domain') . '/media/test.jpg',
            'name' => 'media/test.jpg',
        ];

        $media = $this->mediaService->createMediaForPost($post->id, $uploadData, MediaType::IMAGE);

        $this->assertInstanceOf(Media::class, $media);
        $this->assertEquals($post->id, $media->post_id);
        $this->assertEquals($uploadData['url'], $media->url);
        $this->assertEquals(MediaType::IMAGE, $media->type);
        $this->assertEquals('media/test.jpg', $media->name);
    }

    public function test_delete_file_from_s3()
    {
        $path = 'media/test_' . Str::random(5) . '.jpg';
        Storage::disk('s3')->put($path, 'fake-content');

        $this->assertTrue(Storage::disk('s3')->exists($path));
        $this->assertTrue($this->mediaService->deleteFile($path));
        $this->assertFalse(Storage::disk('s3')->exists($path));
    }

    public function test_delete_media_by_name_removes_file_and_db_record()
    {
        $filename = 'media/test_' . Str::random(5) . '.jpg';
        Storage::disk('s3')->put($filename, 'fake-content');

        $media = Media::factory()->create([
            'url' => config('services.cloudfront.domain') . '/' . $filename,
            'name' => $filename,
        ]);

        $this->assertTrue($this->mediaService->deleteMediaByName($filename));
        $this->assertFalse(Storage::disk('s3')->exists($filename));
        $this->assertDatabaseMissing('media', ['id' => $media->id]);
        // Clean up
        $this->mediaService->deleteFile($filename);
    }

    public function test_delete_media_by_name_fails_if_file_does_not_exist()
    {
        $result = $this->mediaService->deleteMediaByName('nonexistent.jpg');
        $this->assertFalse($result);
    }
}

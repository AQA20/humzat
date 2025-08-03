<?php

namespace App\Services;

use App\Models\Media;
use App\Enums\MediaType;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use App\Services\CloudFrontUrlSigner;
use Illuminate\Support\Facades\Storage;

class MediaService
{
    protected CloudFrontUrlSigner $cloudFrontSigner;

    public function __construct(CloudFrontUrlSigner $cloudFrontSigner)
    {
        $this->cloudFrontSigner = $cloudFrontSigner;
    }

    /**
     * Upload an image file to AWS S3.
     *
     * @param UploadedFile $file
     * @param string|null $folder
     * @return array{url: string, name: string}
     */
    public function uploadImage(UploadedFile $file, ?string $folder = null): array
    {

        $filenameOnly = Str::uuid() . '.' . $file->getClientOriginalExtension();

        Storage::disk('s3')->putFileAs(
            $folder,
            $file,
            $filenameOnly,
        );

        $filename = $folder ? $folder . '/' . $filenameOnly : $filenameOnly;

        // Generate CloudFront signed URL
        $signedUrl = $this->cloudFrontSigner->getSignedUrl($filename);


        return [
            'url' => $signedUrl,
            'name' => $filename,
        ];
    }

    /**
     * Create a media record for a post.
     *
     * @param string $postId
     * @param array $uploadData ['url' => string, 'name' => string]
     * @param MediaType $type
     * @return Media
     */
    public function createMediaForPost(
        string $postId,
        array $uploadData,
        MediaType $type = MediaType::IMAGE
    ): Media {
        return Media::create([
            'post_id' => $postId,
            'url' => $uploadData['url'],
            'type' => $type,
            'name' => $uploadData['name'],
        ]);
    }

    /**
     * Delete a file from AWS S3.
     *
     * @param string $name The key (filename/path) of the file in S3 (e.g. "media/images/uuid.jpg")
     * @return bool True if deleted, false otherwise
     */
    public function deleteFile(string $name): bool
    {
        return Storage::disk('s3')->delete($name);
    }

    /**
     * Delete file from S3 and remove media record by filename stored in name column.
     *
     * @param string $name Filename/path stored in meta->name
     * @return bool True if file and DB record deleted, false otherwise
     */
    public function deleteMediaByName(string $name): bool
    {
        $disk = Storage::disk('s3');

        // Ensure file exists before deleting
        if (!$disk->exists($name)) {
            return false;
        }

        $disk->delete($name);

        $media = Media::where('name', $name)->first();

        if (! $media) {
            return false;
        }

        $media->delete();

        return true;
    }
}

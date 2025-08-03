<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Services\MediaService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Media\UploadImageRequest;
use App\Http\Resources\MediaResource;
use App\Enums\MediaType;

class MediaController extends Controller
{
    protected MediaService $mediaService;

    public function __construct(MediaService $mediaService)
    {
        $this->mediaService = $mediaService;
    }

    /**
     * Display the specified media resource.
     *
     * @group Media Routes
     */
    public function show(Media $media): JsonResponse
    {
        return response()->json([
            'media' => new MediaResource($media),
        ], Response::HTTP_OK);
    }

    /**
     * Store a newly uploaded image and create media record.
     *
     * @group Media Routes
     *
     * @param UploadImageRequest $request
     * @return JsonResponse
     */
    public function store(UploadImageRequest $request): JsonResponse
    {
        $image = $request->file('image');
        $postId = $request->input('post_id');

        $uploadData = $this->mediaService->uploadImage($image, 'media/images');

        $media = $this->mediaService->createMediaForPost($postId, $uploadData, MediaType::IMAGE);

        return response()->json([
            'message' => 'Image uploaded and media created successfully.',
            'media' => new MediaResource($media),
        ], Response::HTTP_CREATED);
    }

    /**
     * Delete the specified media resource.
     *
     * Checks authorization to ensure the user can delete the media,
     * then deletes the media file from storage and removes the database record.
     *
     * @group Media Routes
     *
     * @param Media $media
     * @return JsonResponse
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException If the user is unauthorized to delete the media
     */
    public function destroy(Media $media): JsonResponse
    {
        $this->authorize('delete', $media);

        $name = $media->name;

        if (!$name) {
            return response()->json([
                'message' => 'Media name not found.',
            ], Response::HTTP_BAD_REQUEST);
        }

        $deleted = $this->mediaService->deleteMediaByName($name);

        if (!$deleted) {
            return response()->json([
                'message' => 'Failed to delete media.',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            'message' => 'Media deleted successfully.',
        ], Response::HTTP_OK);
    }
}

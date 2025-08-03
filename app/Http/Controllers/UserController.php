<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Models\User;
use App\Services\MediaService;
use App\Http\Resources\PostResource;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\CommentResource;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\User\UploadUserProfilePictureRequest;

class UserController extends Controller
{
    /**
     * Upload or update the authenticated user's profile picture.
     *
     * @group User Routes
     *
     * @param UploadUserProfilePictureRequest $request
     * @param MediaService $mediaService
     * @return JsonResponse
     */
    public function uploadProfilePicture(
        UploadUserProfilePictureRequest $request,
        MediaService $mediaService
    ): JsonResponse {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $uploadData = $mediaService->uploadImage(
            $request->file('image'),
            'profile_pictures'
        );

        // Delete old profile picture if exists
        if ($user->profile_picture) {
            $mediaService->deleteFile($user->profile_picture);
        }

        $user->update([
            'profile_picture' => $uploadData['name'],
        ]);

        return response()->json([
            'url' => $uploadData['url'],
        ], Response::HTTP_OK);
    }

    /**
     * Show public profile of the specified user.
     *
     * Denies access if blocked.
     *
     * @group User Routes
     *
     * @param User $user
     * @return UserResource|JsonResponse
     */
    public function show(User $user)
    {
        if ($response = $this->denyIfBlocked(auth()->user(), $user)) {
            return $response;
        }

        return new UserResource($user);
    }

    /**
     * Get paginated comments made by the specified user.
     *
     * Denies access if blocked.
     *
     * @group User Routes
     *
     * @param User $user
     * @return AnonymousResourceCollection|JsonResponse
     */
    public function comments(User $user)
    {
        if ($response = $this->denyIfBlocked(auth()->user(), $user)) {
            return $response;
        }

        $comments = $user->comments()->with(['post', 'replies'])->latest()->paginate(10);
        return CommentResource::collection($comments);
    }

    /**
     * Get paginated posts created by the specified user.
     *
     * Denies access if blocked.
     *
     * @group User Routes
     *
     * @param User $user
     * @return AnonymousResourceCollection|JsonResponse
     */
    public function posts(User $user)
    {
        if ($response = $this->denyIfBlocked(auth()->user(), $user)) {
            return $response;
        }

        $posts = $user->posts()
            ->with(['media', 'comments.user', 'comments.replies'])
            ->latest()
            ->paginate(10);

        return PostResource::collection($posts);
    }

    /**
     * Check if the authenticated user is blocked by or has blocked the target user.
     *
     * Returns a JSON response denying access if blocked, or null otherwise.
     *
     * @param User|null $authUser
     * @param User $targetUser
     * @return \Illuminate\Http\JsonResponse|null
     */
    protected function denyIfBlocked(
        ?User $authUser,
        User $targetUser
    ): ?\Illuminate\Http\JsonResponse {
        if (!$authUser) {
            return null;
        }

        if ($authUser->hasBlocked($targetUser) || $authUser->isBlockedBy($targetUser)) {
            return response()->json([
                'message' => 'You are not authorized to access this user\'s data.'
            ], Response::HTTP_FORBIDDEN);
        }

        return null;
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\FollowService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * @group User Follow System
 *
 * APIs for following/unfollowing users and fetching followers/following lists.
 *
 * Requires authentication via Sanctum.
 */
class FollowController extends Controller
{
    protected FollowService $followService;

    public function __construct(FollowService $followService)
    {
        $this->followService = $followService;
    }

    /**
     * Follow a user.
     *
     * Authenticated user follows the specified user.
     *
     * @urlParam user string required The UUID of the user to follow. Example: 123e4567-e89b-12d3-a456-426614174000
     *
     * @response 200 {
     *   "message": "Followed successfully."
     * }
     * @response 401 {
     *   "message": "Unauthenticated."
     * }
     *
     * @authenticated
     *
     * @param User $user
     * @return JsonResponse
     */
    public function follow(User $user): JsonResponse
    {
        $this->followService->follow(auth()->user(), $user);

        return response()->json(['message' => 'Followed successfully.']);
    }

    /**
     * Unfollow a user.
     *
     * Authenticated user unfollows the specified user.
     *
     * @urlParam user string required The UUID of the user to unfollow. Example: 123e4567-e89b-12d3-a456-426614174000
     *
     * @response 200 {
     *   "message": "Unfollowed successfully."
     * }
     * @response 401 {
     *   "message": "Unauthenticated."
     * }
     *
     * @authenticated
     *
     * @param User $user
     * @return JsonResponse
     */
    public function unfollow(User $user): JsonResponse
    {
        $this->followService->unfollow(auth()->user(), $user);

        return response()->json(['message' => 'Unfollowed successfully.']);
    }

    /**
     * Get followers of a user.
     *
     * Returns a paginated list of users who follow the specified user.
     *
     * @urlParam user string required The UUID of the user whose followers are being fetched. Example: 123e4567-e89b-12d3-a456-426614174000
     *
     * @response 200 {
     *   "data": [
     *     {
     *       "id": "123e4567-e89b-12d3-a456-426614174001",
     *       "username": "johndoe",
     *       "name": "John Doe",
     *       "bio": "Example bio",
     *       "profile_picture_url": "https://example.com/profile.jpg",
     *       "followers_count": 10,
     *       "following_count": 5,
     *       "created_at": "2025-08-05T12:00:00Z",
     *       "updated_at": "2025-08-05T12:00:00Z"
     *     }
     *   ],
     *   "links": {},
     *   "meta": {}
     * }
     * @response 401 {
     *   "message": "Unauthenticated."
     * }
     *
     * @authenticated
     *
     * @param User $user
     * @return AnonymousResourceCollection
     */
    public function followers(User $user): AnonymousResourceCollection
    {
        $followers = $this->followService->getFollowers($user);

        return UserResource::collection($followers);
    }

    /**
     * Get users that the user is following.
     *
     * Returns a paginated list of users that the specified user is following.
     *
     * @urlParam user string required The UUID of the user whose following list is being fetched. Example: 123e4567-e89b-12d3-a456-426614174000
     *
     * @response 200 {
     *   "data": [
     *     {
     *       "id": "123e4567-e89b-12d3-a456-426614174002",
     *       "username": "janedoe",
     *       "name": "Jane Doe",
     *       "bio": "Another bio",
     *       "profile_picture_url": "https://example.com/profile2.jpg",
     *       "followers_count": 8,
     *       "following_count": 12,
     *       "created_at": "2025-08-05T12:00:00Z",
     *       "updated_at": "2025-08-05T12:00:00Z"
     *     }
     *   ],
     *   "links": {},
     *   "meta": {}
     * }
     * @response 401 {
     *   "message": "Unauthenticated."
     * }
     *
     * @authenticated
     *
     * @param User $user
     * @return AnonymousResourceCollection
     */
    public function following(User $user): AnonymousResourceCollection
    {
        $following = $this->followService->getFollowing($user);

        return UserResource::collection($following);
    }
}

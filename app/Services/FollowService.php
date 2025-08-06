<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class FollowService
{
    /**
     * Follow a user.
     */
    public function follow(User $follower, User $followed): void
    {
        // Prevent following yourself
        if ($follower->id === $followed->id) {
            return;
        }

        $follower->following()->syncWithoutDetaching([$followed->id]);
    }

    /**
     * Unfollow a user.
     */
    public function unfollow(User $follower, User $followed): void
    {
        $follower->following()->detach($followed->id);
    }

    /**
     * Get paginated followers of a user.
     */
    public function getFollowers(User $user, int $perPage = 10): LengthAwarePaginator
    {
        return $user->followers()->paginate($perPage);
    }

    /**
     * Get paginated users that the given user is following.
     */
    public function getFollowing(User $user, int $perPage = 10): LengthAwarePaginator
    {
        return $user->following()->paginate($perPage);
    }
}

<?php

namespace App\Services;

use App\Models\Post;
use App\Models\User;

class SaveService
{
    /**
     * Save a post for a user.
     */
    public function savePost(User $user, Post $post): void
    {
        // Avoid saving the same post twice
        $user->savedPosts()->syncWithoutDetaching([$post->id]);
    }

    /**
     * Unsave a post for a user.
     */
    public function unsavePost(User $user, Post $post): void
    {
        $user->savedPosts()->detach($post->id);
    }

    /**
     * Get all saved posts for a user.
     */
    public function getSavedPosts(User $user, int $perPage = 10)
    {
        return $user->savedPosts()->latest()->paginate($perPage);
    }
}

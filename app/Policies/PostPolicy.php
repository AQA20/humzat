<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;


class PostPolicy
{
    /**
     * Allow listing posts (e.g., /api/posts).
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Allow viewing any single post.
     */
    public function view(User $user, Post $post): bool
    {
        return true;
    }

    /**
     * Allow any authenticated user to create posts.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Only allow the post owner to update.
     */
    public function update(User $user, Post $post): bool
    {
        return $user->id === $post->user_id;
    }

    /**
     * Only allow the post owner to delete.
     */
    public function delete(User $user, Post $post): bool
    {
        return $user->id === $post->user_id;
    }

    /**
     * Not implemented yet.
     */
    public function restore(User $user, Post $post): bool
    {
        return false;
    }

    /**
     * Not implemented yet.
     */
    public function forceDelete(User $user, Post $post): bool
    {
        return false;
    }
}

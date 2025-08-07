<?php

namespace App\Services;

use App\Models\Post;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Support\Str;

class VoteService
{
    public function vote(User $user, Post $post, bool $isUpvote): ?Vote
    {
        $existing = Vote::where('user_id', $user->id)
            ->where('post_id', $post->id)
            ->first();

        if ($existing) {
            if ($existing->is_upvote === $isUpvote) {
                // Same vote again = remove (toggle off)
                $existing->delete();
                return null;
            }

            // Change direction
            $existing->is_upvote = $isUpvote;
            $existing->save();
            return $existing;
        }

        return Vote::create([
            'id' => Str::uuid(),
            'user_id' => $user->id,
            'post_id' => $post->id,
            'is_upvote' => $isUpvote,
        ]);
    }

    public function removeVote(User $user, Post $post): void
    {
        Vote::where('user_id', $user->id)
            ->where('post_id', $post->id)
            ->delete();
    }
}

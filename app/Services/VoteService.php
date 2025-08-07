<?php

namespace App\Services;

use App\Models\User;
use App\Models\Vote;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class VoteService
{
    public function vote(User $user, Model $votable, bool $isUpvote): ?Vote
    {
        if (!method_exists($votable, 'votes')) {
            throw new \InvalidArgumentException("Model " . get_class($votable) . " is not votable.");
        }

        $existing = Vote::where('user_id', $user->id)
            ->where('votable_id', $votable->getKey())
            ->where('votable_type', $votable::class)
            ->first();

        if ($existing) {
            if ($existing->is_upvote === $isUpvote) {
                $existing->delete(); // toggle off
                return null;
            }

            $existing->update(['is_upvote' => $isUpvote]);
            return $existing;
        }

        return Vote::create([
            'id' => Str::uuid(),
            'user_id' => $user->id,
            'votable_id' => $votable->getKey(),
            'votable_type' => $votable::class,
            'is_upvote' => $isUpvote,
        ]);
    }
}

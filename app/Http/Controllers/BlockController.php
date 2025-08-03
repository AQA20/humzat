<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Block;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class BlockController extends Controller
{
    /**
     * List users you have blocked
     *
     * @group Block Routes
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $blockedUsers = $request->user()
            ->blocks()
            ->with('blocked') // eager load related user info
            ->latest()
            ->paginate(10);

        return UserResource::collection(
            $blockedUsers->map(fn($block) => $block->blocked)
        );
    }

    /**
     * Block a user
     *
     * @group Block Routes
     */
    public function store(Request $request, User $user)
    {
        $targetUserId = $request->user()->id;
        if ($targetUserId === $user->id) {
            return response()->json(['message' => 'You cannot block yourself.'], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $alreadyBlocked = Block::where('blocker_id', $targetUserId)
            ->where('blocked_id', $user->id)
            ->exists();

        if ($alreadyBlocked) {
            return response()->json(['message' => 'User already blocked.'], Response::HTTP_OK);
        }

        Block::create([
            'blocker_id' => $targetUserId,
            'blocked_id' => $user->id,
        ]);

        return response()->json(['message' => 'User blocked.'], Response::HTTP_CREATED);
    }

    /**
     * Unblock a user
     *
     * @group Block Routes
     */
    public function destroy(Request $request, User $user)
    {
        $deleted = Block::where('blocker_id', $request->user()->id)
            ->where('blocked_id', $user->id)
            ->delete();

        return response()->json([
            'message' => $deleted ? 'User unblocked.' : 'User was not blocked.',
        ], Response::HTTP_OK);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\VoteRequest;
use App\Models\Comment;
use App\Models\Post;
use App\Services\VoteService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * @group Voting
 *
 * APIs for voting on posts or comments.
 */
class VoteController extends Controller
{
    public function __construct(protected VoteService $voteService) {}

    /**
     * Cast or update a vote on a votable model (Post or Comment).
     *
     * @bodyParam votable_type string required The type of content being voted on. Example: post
     * @bodyParam votable_id string required The UUID of the content. Example: 05b4be84-121f-4b6c-8829-9e4a6cefd4cc
     * @bodyParam is_upvote boolean required Whether the vote is an upvote (true) or downvote (false). Example: true
     *
     * @response 200 {
     *   "message": "Vote recorded successfully.",
     *   "data": {
     *     "id": "62b4b60d-965a-4f2e-a940-0e8b0e7e5f55",
     *     "user_id": "2c373f91-20e9-4f04-92aa-cb8021d85ae0",
     *     "votable_id": "05b4be84-121f-4b6c-8829-9e4a6cefd4cc",
     *     "votable_type": "App\\Models\\Post",
     *     "is_upvote": true,
     *     "created_at": "2025-08-07T09:40:10.000000Z",
     *     "updated_at": "2025-08-07T09:40:10.000000Z"
     *   }
     * }
     */
    public function vote(VoteRequest $request): JsonResponse
    {
        $votable = $this->resolveVotableModel(
            $request->input('votable_type'),
            $request->input('votable_id')
        );

        $vote = $this->voteService->vote(
            $request->user(),
            $votable,
            $request->boolean('is_upvote')
        );

        return response()->json([
            'message' => 'Vote recorded successfully.',
            'data' => $vote,
        ], Response::HTTP_OK);
    }

    /**
     * Resolve a votable model instance (Post or Comment) based on type and ID.
     *
     * This method accepts a `votable_type` string and a model ID,
     * and returns the corresponding Post or Comment model instance.
     *
     * If the `votable_type` is "post", it will attempt to find a Post by the given ID.
     * If the `votable_type` is "comment", it will attempt to find a Comment by the given ID.
     *
     * If the type is invalid or the model is not found, it aborts with a 422 response.
     *
     * @param string $type The type of votable model (either "post" or "comment").
     * @param string $id The ID of the model to retrieve.
     * @return Post|Comment
     */
    protected function resolveVotableModel(string $type, string $id): Post|Comment
    {
        return match (strtolower($type)) {
            'post' => Post::findOrFail($id),
            'comment' => Comment::findOrFail($id),
            default => abort(
                Response::HTTP_UNPROCESSABLE_ENTITY,
                'Invalid votable_type. Must be "post" or "comment".'
            )
        };
    }
}

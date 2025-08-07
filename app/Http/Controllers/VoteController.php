<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Services\VoteService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\VoteRequest;
use Symfony\Component\HttpFoundation\Response;


class VoteController extends Controller
{
    public function __construct(protected VoteService $voteService) {}


    /**
     * Submit a vote on a post (upvote or downvote).
     *
     * Sends a vote for the specified post. The vote can be either an upvote or a downvote,
     * determined by the `is_upvote` boolean value.
     *
     * @group Votes
     * @authenticated
     *
     * @urlParam post string required The UUID of the post.
     * @bodyParam is_upvote boolean required Whether the vote is an upvote (true) or downvote (false). Example: true
     *
     * @response 200 {
     *   "message": "Vote registered."
     * }
     */
    public function vote(Post $post, VoteRequest $request): JsonResponse
    {
        $this->voteService->vote($request->user(), $post, $request->boolean('is_upvote'));

        return response()->json(['message' => 'Vote registered.'], Response::HTTP_OK);
    }


    /**
     * Remove vote from a post.
     *
     * Removes the user's existing vote (upvote or downvote) from the post.
     *
     * @group Votes
     * @authenticated
     *
     * @urlParam post string required The UUID of the post.
     *
     * @response 200 {
     *   "message": "Vote removed."
     * }
     */
    public function removeVote(Post $post, Request $request): JsonResponse
    {
        $this->voteService->removeVote($request->user(), $post);

        return response()->json(['message' => 'Vote removed.'], Response::HTTP_OK);
    }
}

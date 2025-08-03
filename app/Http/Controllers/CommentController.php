<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\CommentResource;
use App\Http\Requests\Comments\StoreCommentRequest;
use App\Http\Requests\Comments\UpdateCommentRequest;
use App\Http\Requests\Comments\DeleteCommentRequest;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a paginated list of top-level comments with their replies.
     *
     * @group Comment Routes
     */
    public function index()
    {
        $comments = Comment::with(['user', 'replies.user'])
            ->whereNull('parent_id')
            ->latest()
            ->paginate(10);

        return CommentResource::collection($comments);
    }

    /**
     * Store a newly created comment.
     *
     * @group Comment Routes
     */
    public function store(StoreCommentRequest $request)
    {
        $data = $request->validated();

        $comment = Comment::create([
            'user_id' => Auth::id(),
            'post_id' => $data['post_id'],
            'body' => $data['body'],
            'parent_id' => $data['parent_id'] ?? null,
        ]);

        return new CommentResource($comment->load(['user', 'replies.user']));
    }

    /**
     * Display a specific comment along with its replies.
     *
     * @group Comment Routes
     */
    public function show(Comment $comment)
    {
        $comment->load(['user', 'replies.user']);

        return new CommentResource($comment);
    }

    /**
     * Update a comment if the authenticated user is the owner.
     *
     * @group Comment Routes
     */
    public function update(UpdateCommentRequest $request, string $id)
    {
        $comment = Comment::findOrFail($id);

        if ($comment->user_id !== Auth::id()) {
            return response()->json([
                'message' => 'Unauthorized',
            ], Response::HTTP_FORBIDDEN);
        }

        $comment->update($request->validated());

        return new CommentResource($comment->fresh('user', 'replies.user'));
    }

    /**
     * Delete a comment.
     *
     * @group Comment Routes
     */
    public function destroy(DeleteCommentRequest $request, Comment $comment)
    {
        $comment->delete();

        return response()->json([
            'message' => 'Comment deleted successfully',
        ], Response::HTTP_OK);
    }
}

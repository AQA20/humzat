<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Services\SaveService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SaveController extends Controller
{
    protected SaveService $saveService;

    public function __construct(SaveService $saveService)
    {
        $this->saveService = $saveService;
    }

    /**
     * Save a post.
     *
     * @group Saved Posts
     * @authenticated
     * @urlParam post_id UUID required The ID of the post to save.
     * @response 200 { "message": "Post saved successfully." }
     */
    public function save(Post $post): JsonResponse
    {
        $this->saveService->savePost(auth()->user(), $post);

        return response()->json(['message' => 'Post saved successfully.']);
    }

    /**
     * Unsave a post.
     *
     * @group Saved Posts
     * @authenticated
     * @urlParam post_id UUID required The ID of the post to unsave.
     * @response 200 { "message": "Post unsaved successfully." }
     */
    public function unsave(Post $post): JsonResponse
    {
        $this->saveService->unsavePost(auth()->user(), $post);

        return response()->json(['message' => 'Post unsaved successfully.']);
    }

    /**
     * Get all saved posts.
     *
     * @group Saved Posts
     * @authenticated
     * @queryParam page int Page number for pagination.
     * @response 200 {
     *   "data": [ ...PostResource... ],
     *   "meta": { ... },
     *   "links": { ... }
     * }
     */
    public function index(Request $request)
    {
        $posts = $this->saveService->getSavedPosts(auth()->user());

        return PostResource::collection($posts);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Hashtag;
use App\Events\PostShared;
use App\Events\PostViewed;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use App\Http\Requests\Posts\StorePostRequest;
use App\Http\Requests\Posts\DeletePostRequest;
use App\Http\Requests\Posts\UpdatePostRequest;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    /**
     * Display a paginated list of posts with related data.
     *
     * @group Post Routes
     */
    public function index()
    {
        $posts = Post::with([
            'user',
            'hashtags',
            'comments.replies.user',
            'comments.user',
            'media'
        ])->latest()->paginate(10);

        return PostResource::collection($posts)
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Sync hashtags with the given tags array.
     *
     * @param Post $post
     * @param array $tags
     * @return void
     */
    private function syncHashtags(Post $post, array $tags): void
    {
        $tagIds = [];

        foreach ($tags as $tag) {
            $cleaned = ltrim(strtolower(trim($tag)), '#'); // remove leading '#' if present
            if ($cleaned === '') {
                continue; // skip empty or malformed tags
            }

            $hashtag = Hashtag::firstOrCreate(
                ['name' => $cleaned],
                ['id' => (string) Str::uuid()]
            );
            $tagIds[] = $hashtag->id;
        }

        $post->hashtags()->sync($tagIds);
    }

    /**
     * Store a newly created post.
     *
     * @group Post Routes
     */
    public function store(StorePostRequest $request)
    {
        $validatedRequest = $request->validated();
        $externalUrl = $validatedRequest['external_url'];

        if ($externalUrl && $validatedRequest['unique_external_url']) {
            $existingPost = Post::where('external_url', $externalUrl)->first();
            if ($existingPost) {
                return response()->json([
                    'message' => 'A post with the same external URL already exists.',
                ]);
            }
        }

        $post = $request->user()->posts()->create($validatedRequest);

        // sync hashtags if provided
        $tags = data_get($validatedRequest, 'meta.tags', null);
        if (!is_null($tags)) {
            $this->syncHashtags($post, $tags);
        }

        return (new PostResource($post->load([
            'user',
            'hashtags',
            'comments.replies.user',
            'comments.user',
            'media'
        ])))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display a single post by ID.
     *
     * @group Post Routes
     */
    public function show(Request $request, Post $post)
    {
        PostViewed::dispatch($post, $request->ip());

        return (new PostResource($post->load([
            'user',
            'hashtags',
            'comments.replies.user',
            'comments.user',
            'media'
        ])))
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Update the specified post.
     *
     * @group Post Routes
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $this->authorize('update', $post);

        $validated = $request->validated();

        $post->update($validated);

        // If the client sent meta.tags (even empty array), sync it.
        if ($request->has('meta.tags')) {
            $this->syncHashtags($post, $validated['meta']['tags'] ?? []);
        }

        return (new PostResource($post->load([
            'user',
            'hashtags',
            'comments.replies.user',
            'comments.user',
            'media'
        ])))
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Delete the specified post.
     *
     * @group Post Routes
     */
    public function destroy(DeletePostRequest $request, Post $post)
    {
        $this->authorize('delete', $post);

        $post->delete();

        return response()->json([
            'message' => 'Post deleted successfully',
        ], Response::HTTP_OK);
    }

    /**
     * Increment the post share count.
     *
     * @group Post Routes
     */
    public function share(Request $request, Post $post)
    {
        PostShared::dispatch($post, $request->ip());
        return response()->json([
            'message' => 'Post shares count was successfully updated',
        ], Response::HTTP_OK);
    }
}

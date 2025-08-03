<?php

namespace App\Http\Controllers;

use App\Models\Hashtag;
use Illuminate\Http\Request;
use App\Http\Resources\HashtagResource;
use App\Http\Resources\PostResource;

class HashtagController extends Controller
{
    /**
     * Display a paginated list of hashtags with the count of related posts.
     *
     * @group Hashtag Routes
     */
    public function index(Request $request)
    {
        $hashtags = Hashtag::withCount('posts')
            ->orderByDesc('posts_count')
            ->paginate(10);

        return HashtagResource::collection($hashtags);
    }

    /**
     * Display the specified hashtag along with its related posts (paginated).
     *
     * @group Hashtag Routes
     */
    public function show(Hashtag $hashtag)
    {
        $posts = $hashtag->posts()
            ->with(['user', 'media', 'hashtags'])
            ->latest()
            ->paginate(10);

        return response()->json([
            'hashtag' => new HashtagResource($hashtag),
            'posts' => PostResource::collection($posts)->response()->getData(true),
        ]);
    }

    /**
     * Get the specified hashtag by its name, along with its related posts (paginated).
     *
     * @group Hashtag Routes
     */
    public function showByName(string $name)
    {
        $hashtag = Hashtag::where('name', $name)->firstOrFail();

        $posts = $hashtag->posts()
            ->with(['user', 'media', 'hashtags'])
            ->latest()
            ->paginate(10);

        return response()->json([
            'hashtag' => new HashtagResource($hashtag),
            'posts' => PostResource::collection($posts)->response()->getData(true),
        ]);
    }
}

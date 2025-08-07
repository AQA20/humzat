<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserResource;

class PostResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'body' => $this->body,
            'external_url' => $this->external_url,
            'meta' => $this->meta,
            'hashtags' => $this->whenLoaded('hashtags', fn() => $this->hashtags->pluck('name')),
            'votes' => [
                'upvotes' => $this->upvotes()->count(),
                'downvotes' => $this->downvotes()->count(),
            ],
            'media' => MediaResource::collection($this->whenLoaded('media')),
            'comments'  => CommentResource::collection($this->whenLoaded('comments')),
            'type' => $this->type,
            'user' => new UserResource($this->whenLoaded('user')),
            'my_vote' => $this->when($request->user(), function () use ($request) {
                $vote = $this->votes()
                    ->where('user_id', $request->user()->id)
                    ->first();

                return $vote ? ($vote->is_upvote ? 'upvote' : 'downvote') : null;
            }),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}

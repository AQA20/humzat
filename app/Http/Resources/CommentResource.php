<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'        => $this->id,
            'body'      => $this->body,
            'user'      => new UserResource($this->whenLoaded('user')),
            'replies'   => CommentResource::collection($this->whenLoaded('replies')),
            'votes' => [
                'upvotes' => $this->upvotes()->count(),
                'downvotes' => $this->downvotes()->count(),
            ],
            'my_vote' => $this->when($request->user(), function () use ($request) {
                $vote = $this->votes()
                    ->where('user_id', $request->user()->id)
                    ->first();

                return $vote ? ($vote->is_upvote ? 'upvote' : 'downvote') : null;
            }),
            'parent_id' => $this->parent_id,
            'created_at' => $this->created_at,
        ];
    }
}

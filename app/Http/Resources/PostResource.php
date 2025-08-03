<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserResource;

class PostResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        // Make sure meta is always an array
        $meta = $this->meta ?? [];

        // Override or set 'tags' inside meta from hashtags relation if loaded
        if ($this->relationLoaded('hashtags')) {
            $meta['tags'] = $this->hashtags->pluck('name')->toArray();
        }

        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'body' => $this->body,
            'external_url' => $this->external_url,
            'meta' => $meta,
            'hashtags' => $this->whenLoaded('hashtags', fn() => $this->hashtags->pluck('name')),
            'media' => MediaResource::collection($this->whenLoaded('media')),
            'comments'  => CommentResource::collection($this->whenLoaded('comments')),
            'type' => $this->type,
            'user' => new UserResource($this->whenLoaded('user')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


class UserResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'name' => $this->name,
            'bio' => $this->bio,
            'profile_picture_url' => $this->profile_picture_url,
            'created_at' => $this->created_at->toIso8601String(),
            'updated_at' => $this->updated_at->toIso8601String(),
            // Only show email if user is viewing their own profile
            $this->mergeWhen(
                $request->user() && $request->user()->id === $this->id,
                ['email' => $this->email]
            ),
        ];
    }
}

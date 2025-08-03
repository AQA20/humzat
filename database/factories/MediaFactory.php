<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\Media;
use App\Enums\MediaType;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class MediaFactory extends Factory
{
    protected $model = Media::class;

    public function definition(): array
    {
        $filename = 'media/test_' . Str::random(10) . '.jpg';

        return [
            'id' => (string) Str::uuid(),
            'name' => $filename,
            'url' => config('services.cloudfront.domain') . '/' . $filename,
            'type' => MediaType::IMAGE, // safer than raw 'image'
            'meta' => ['original_name' => $filename],
            'post_id' => Post::factory(),
        ];
    }
}

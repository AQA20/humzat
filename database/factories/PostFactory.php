<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        return [
            'id' => (string) Str::uuid(),
            'user_id' => User::factory(),
            'body' => $this->faker->paragraph(),
            'external_url' => $this->faker->optional()->url(),
            'meta' => $this->faker->optional()->randomElement([
                null,
                [
                    'tags' => $this->faker->words(3),
                    'domain' => $this->faker->domainName(),
                    'embed' => [
                        'title' => $this->faker->sentence(),
                        'description' => $this->faker->paragraph(),
                        'image' => $this->faker->imageUrl(640, 480, 'news', true),
                        'video' => null,
                    ],
                ],
            ]),
        ];
    }
}

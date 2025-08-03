<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PostShare>
 */
class PostShareFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'post_id' => Post::factory(),
            'ip_address' => $this->faker->ipv6(),
            'uuid' => Str::uuid()->toString(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

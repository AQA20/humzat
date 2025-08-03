<?php

namespace Database\Factories;

use App\Models\Hashtag;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class HashtagFactory extends Factory
{
    protected $model = Hashtag::class;

    public function definition(): array
    {
        return [
            'name' => Str::slug($this->faker->unique()->words(2, true)),
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Comment;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Str;

class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition()
    {
        return [
            'id' => (string) Str::uuid(), // UUID as string for primary key
            'user_id' => User::factory(), // creates a new user unless overridden
            'post_id' => Post::factory(), // creates a new post unless overridden
            'body' => $this->faker->paragraph(2),
            'parent_id' => null, // default to top-level comment
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    /**
     * Indicate this comment is a reply to another comment
     *
     * @param  \App\Models\Comment  $parent
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function replyTo(Comment $parent)
    {
        return $this->state(function () use ($parent) {
            return [
                'parent_id' => $parent->id,
                'post_id' => $parent->post_id,
            ];
        });
    }
}

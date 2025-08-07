<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasUuids, HasFactory;

    protected $fillable = [
        'user_id',
        'post_id',
        'body',
        'parent_id', // for replies
    ];

    public $incrementing = false;
    protected $keyType = 'string';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    public function votes()
    {
        return $this->morphMany(Vote::class, 'votable');
    }

    public function upvotes()
    {
        return $this->votes()->where('is_upvote', true);
    }

    public function downvotes()
    {
        return $this->votes()->where('is_upvote', false);
    }
}

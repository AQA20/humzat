<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use App\Models\Hashtag;
use App\Enums\PostType;

class Post extends Model
{
    use HasFactory, HasUuids;  // add HasFactory here

    protected $fillable = [
        'user_id',
        'body',
        'external_url',
        'media_url', // external embed
        'type', // text, video, etc.
        'meta'
    ];


    protected $casts = [
        'meta' => 'array',  // Laravel will auto serialize/deserialize JSON here
        'type' => PostType::class,
    ];

    public $incrementing = false;
    protected $keyType = 'string';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function hashtags()
    {
        return $this->belongsToMany(Hashtag::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function media()
    {
        return $this->hasMany(Media::class);
    }

    public function savedByUsers()
    {
        return $this->belongsToMany(
            User::class,
            'post_user_saves',
            'post_id',
            'user_id'
        )->withTimestamps();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vote extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string'; // UUID

    protected $fillable = [
        'id',
        'user_id',
        'votable_id',
        'votable_type',
        'is_upvote',
    ];

    protected $casts = [
        'is_upvote' => 'boolean',
    ];

    public function votable(): MorphTo
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

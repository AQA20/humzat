<?php

namespace App\Models;

use App\Enums\MediaType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Media extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'media';

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'post_id',
        'name',
        'url',
        'type',
        'meta',
    ];

    protected $casts = [
        'id' => 'string',
        'post_id' => 'string',
        'name' => 'string',
        'meta' => 'array',
        'type' => MediaType::class,
    ];

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}

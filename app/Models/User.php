<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use App\Services\CloudFrontUrlSigner;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'username',
        'email',
        'password',
        'name',
        'bio',
        'profile_picture',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'email',
    ];

    // Relationships
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function claims()
    {
        return $this->hasMany(Claim::class);
    }


    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function blocks()
    {
        return $this->hasMany(Block::class, 'blocker_id');
    }

    public function blockedBy()
    {
        return $this->hasMany(Block::class, 'blocked_id');
    }

    public function hasBlocked(User $user): bool
    {
        return $this->blocks()->where('blocked_id', $user->id)->exists();
    }

    public function isBlockedBy(User $user): bool
    {
        return $this->blockedBy()->where('blocker_id', $user->id)->exists();
    }

    public function getProfilePictureUrlAttribute(): ?string
    {
        if (!$this->profile_picture) {
            return null;
        }

        /** @var CloudFrontUrlSigner $signer */
        $signer = app(CloudFrontUrlSigner::class);

        return $signer->getSignedUrl($this->profile_picture);
    }
}

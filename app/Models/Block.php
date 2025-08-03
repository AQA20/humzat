<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Block extends Model
{
    use HasFactory;

    public $incrementing = false;
    public $timestamps = true;
    protected $keyType = 'string';

    protected $primaryKey = ['blocker_id', 'blocked_id'];

    protected $fillable = [
        'blocker_id',
        'blocked_id',
    ];

    public function blocker()
    {
        return $this->belongsTo(User::class, 'blocker_id');
    }

    public function blocked()
    {
        return $this->belongsTo(User::class, 'blocked_id');
    }

    // Override to disable default behavior expecting a single primary key
    public function getKeyName()
    {
        return null; // Laravel will rely on the manually defined composite key
    }

    public function getIncrementing()
    {
        return false;
    }
}

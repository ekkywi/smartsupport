<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class UserToken extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'user_id',
        'token',
        'type',
        'is_used',
        'expired_at'
    ];

    protected $hidden = [
        'token'
    ];

    protected $casts = [
        'is_used' => 'boolean',
        'expired_at' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
};

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Position extends Model
{
    use HasUuids;

    protected $fillable = [
        'position_code',
        'name',
    ];

    protected $hidden = [];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'id');
    }
}

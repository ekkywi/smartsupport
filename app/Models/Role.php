<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Testing\Fluent\Concerns\Has;

class Role extends Model
{
    use HasUuids;

    protected $fillable = [
        'role_code',
        'name',
    ];

    protected $hidden = [];

    public function users()
    {
        return $this->hasMany(User::class, 'id');
    }
}

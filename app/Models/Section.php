<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Section extends Model
{
    use HasUuids;

    protected $fillable = [
        'section_code',
        'name',
    ];

    protected $hidden = [];

    public function users()
    {
        return $this->hasMany(User::class, 'id');
    }
}

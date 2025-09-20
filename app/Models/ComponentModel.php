<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class ComponentModel extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'name',
        'component_model_code',
        'component_type_id',
        'brand_id',
        'specs',
        'description',
    ];

    protected $casts = [
        'specs' => 'array',
    ];

    public function componentType()
    {
        return $this->belongsTo(ComponentType::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}

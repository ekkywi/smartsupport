<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComponentModel extends Model
{
    protected $fillable = [
        'name',
        'component_model_code',
        'component_type_id',
        'brand_id',
        'specs',
        'description',
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

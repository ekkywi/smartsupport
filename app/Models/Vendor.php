<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Vendor extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $fillable = [
        'vendor_code',
        'name',
        'contact_person',
        'phone',
        'email',
        'website',
        'address',
        'postal_code',
        'city',
        'province',
        'country',
        'notes',
    ];
}

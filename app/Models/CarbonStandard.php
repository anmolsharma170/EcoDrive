<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarbonStandard extends Model
{
    protected $fillable = ['fuel_type', 'emission_factor'];

    protected $casts = [
        'emission_factor' => 'decimal:4',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EcoTip extends Model
{
    protected $fillable = [
        'title',
        'description',
        'estimated_co2_savings_kg',
        'category',
        'icon',
    ];

    protected $casts = [
        'estimated_co2_savings_kg' => 'decimal:1',
    ];
}

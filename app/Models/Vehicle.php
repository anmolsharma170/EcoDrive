<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'make',
        'model',
        'year',
        'fuel_type',
        'engine_cc',
        'co2_per_km',
        'emission_rating',
        'is_primary',
    ];

    protected $casts = [
        'is_primary' => 'boolean',
        'co2_per_km' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function trips()
    {
        return $this->hasMany(Trip::class);
    }

    // EU-style emission rating badge color
    public function getRatingColorAttribute(): string
    {
        return match($this->emission_rating) {
            'A++' => '#00C853',
            'A+'  => '#4CAF50',
            'A'   => '#8BC34A',
            'B'   => '#CDDC39',
            'C'   => '#FFC107',
            'D'   => '#FF9800',
            'E'   => '#FF5722',
            'F'   => '#F44336',
            default => '#9E9E9E',
        };
    }

    public function getDisplayNameAttribute(): string
    {
        return "{$this->year} {$this->make} {$this->model}";
    }
}

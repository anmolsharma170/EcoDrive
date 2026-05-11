<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'vehicle_id',
        'distance_km',
        'co2_emitted_kg',
        'date',
        'vehicle_type',
        'fuel_type',
        'notes',
    ];

    protected $casts = [
        'date' => 'date',
        'distance_km' => 'decimal:2',
        'co2_emitted_kg' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    // Emission badge color: green < 2kg, yellow < 5kg, red >= 5kg
    public function getEmissionBadgeAttribute(): string
    {
        if ($this->co2_emitted_kg < 2) return 'green';
        if ($this->co2_emitted_kg < 5) return 'yellow';
        return 'red';
    }

    // CO2 in coal equivalent kg (1 kg coal ≈ 2.42 kg CO2)
    public function getCoalEquivalentAttribute(): float
    {
        return round($this->co2_emitted_kg / 2.42, 2);
    }
}

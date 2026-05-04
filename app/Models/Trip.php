<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    protected $fillable = [
        'user_id',
        'vehicle_id',
        'distance_km',
        'fuel_consumed',
        'carbon_emission',
        'eco_points_earned',
        'trip_date',
    ];

    protected $casts = [
        'trip_date'        => 'date',
        'carbon_emission'  => 'decimal:4',
        'eco_points_earned'=> 'decimal:4',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}

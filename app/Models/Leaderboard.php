<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Leaderboard extends Model
{
    public $timestamps = false;

    protected $table = 'leaderboard';

    protected $fillable = [
        'user_id',
        'total_eco_score',
        'total_trips',
        'total_co2_saved',
        'rank',
    ];

    protected $casts = [
        'total_eco_score' => 'decimal:2',
        'total_co2_saved' => 'decimal:4',
        'updated_at'      => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

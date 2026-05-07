<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'eco_score',
        'co2_saved_this_month',
        'trips_logged',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relationships
    public function trips()
    {
        return $this->hasMany(Trip::class);
    }

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }

    public function streak()
    {
        return $this->hasOne(UserStreak::class);
    }

    public function achievements()
    {
        return $this->belongsToMany(Achievement::class, 'user_achievements')
            ->withPivot('unlocked_at')
            ->withTimestamps();
    }

    // Computed: Eco Grade (A/B/C/D/F)
    public function getEcoGradeAttribute(): string
    {
        $score = $this->eco_score ?? 0;
        if ($score >= 900) return 'A+';
        if ($score >= 750) return 'A';
        if ($score >= 600) return 'B';
        if ($score >= 400) return 'C';
        if ($score >= 200) return 'D';
        return 'F';
    }

    // Computed: Trees saved (1 tree absorbs ~21kg CO2/year = 1.75kg/month)
    public function getTreesSavedAttribute(): float
    {
        return round(($this->co2_saved_this_month ?? 0) / 1.75, 1);
    }

    // Current streak days
    public function getCurrentStreakAttribute(): int
    {
        return $this->streak?->current_streak ?? 0;
    }
}

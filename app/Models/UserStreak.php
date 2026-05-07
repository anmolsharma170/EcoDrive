<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserStreak extends Model
{
    protected $fillable = [
        'user_id',
        'current_streak',
        'longest_streak',
        'last_activity_date',
    ];

    protected $casts = [
        'last_activity_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Update streak based on today's activity
     */
    public static function updateForUser(User $user): void
    {
        $streak = $user->streak()->firstOrCreate(['user_id' => $user->id]);
        $today = now()->toDateString();
        $yesterday = now()->subDay()->toDateString();

        if ($streak->last_activity_date?->toDateString() === $today) {
            // Already updated today
            return;
        }

        if ($streak->last_activity_date?->toDateString() === $yesterday) {
            // Consecutive day
            $streak->current_streak += 1;
        } else {
            // Streak broken or new
            $streak->current_streak = 1;
        }

        $streak->longest_streak = max($streak->longest_streak, $streak->current_streak);
        $streak->last_activity_date = $today;
        $streak->save();
    }
}

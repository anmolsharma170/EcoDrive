<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\EcoTip;
use App\Models\Trip;
use App\Models\User;
use App\Models\UserStreak;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Rank
        $rank = User::where('eco_score', '>', $user->eco_score)->count() + 1;
        $totalUsers = User::count();

        // Next rank user score
        $nextRankUser = User::where('eco_score', '>', $user->eco_score)
            ->orderBy('eco_score')
            ->first();
        $pointsToNextRank = $nextRankUser
            ? $nextRankUser->eco_score - $user->eco_score
            : 0;

        // Streak
        $streak = UserStreak::where('user_id', $user->id)->first();
        $currentStreak = $streak?->current_streak ?? 0;

        // Weekly CO2 Chart
        $weeklyTrips = Trip::where('user_id', $user->id)
            ->where('date', '>=', now()->subDays(7))
            ->orderBy('date')
            ->get()
            ->groupBy(fn($t) => $t->date->format('Y-m-d'));

        $chartDates = [];
        $chartData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $chartDates[] = now()->subDays($i)->format('D');
            $chartData[] = isset($weeklyTrips[$date])
                ? round($weeklyTrips[$date]->sum('co2_emitted_kg'), 2)
                : 0;
        }

        // Recent trips
        $recentTrips = Trip::where('user_id', $user->id)
            ->orderBy('date', 'desc')
            ->take(5)
            ->get();

        // Achievements
        $userAchievements = $user->achievements()->orderBy('user_achievements.unlocked_at', 'desc')->take(3)->get();

        // Eco tips
        $ecoTips = EcoTip::inRandomOrder()->take(3)->get();

        // Platform stats (for emotional impact)
        $platformCO2Saved = User::sum('co2_saved_this_month');
        $platformTrips = Trip::count();

        // CO2 this month
        $co2ThisMonth = Trip::where('user_id', $user->id)
            ->whereMonth('date', now()->month)
            ->sum('co2_emitted_kg');

        $treesEquivalent = round($user->co2_saved_this_month / 1.75, 1);

        return view('dashboard', compact(
            'user', 'rank', 'totalUsers', 'pointsToNextRank',
            'currentStreak', 'chartDates', 'chartData',
            'recentTrips', 'userAchievements', 'ecoTips',
            'platformCO2Saved', 'platformTrips', 'co2ThisMonth', 'treesEquivalent'
        ));
    }
}

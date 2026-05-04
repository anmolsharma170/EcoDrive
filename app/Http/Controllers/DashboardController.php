<?php

namespace App\Http\Controllers;

use App\Models\Leaderboard;
use App\Models\Trip;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $totalTrips   = $user->trips()->count();
        $totalCo2     = $user->trips()->sum('carbon_emission');
        $ecoScore     = $user->eco_score;

        // Chart data — last 7 trips (eco points over time)
        $recentTrips = $user->trips()
            ->with('vehicle')
            ->orderByDesc('trip_date')
            ->take(7)
            ->get()
            ->reverse()
            ->values();

        $chartLabels = $recentTrips->map(fn($t) => $t->trip_date->format('M d'))->toArray();
        $chartData   = $recentTrips->map(fn($t) => round($t->eco_points_earned, 2))->toArray();

        // User's leaderboard rank
        $leaderboard  = Leaderboard::where('user_id', $user->id)->first();
        $userRank     = $leaderboard?->rank ?? '—';

        return view('dashboard.index', compact(
            'user', 'totalTrips', 'totalCo2', 'ecoScore',
            'recentTrips', 'chartLabels', 'chartData', 'userRank'
        ));
    }
}

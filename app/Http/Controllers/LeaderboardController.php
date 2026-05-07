<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LeaderboardController extends Controller
{
    public function index(Request $request)
    {
        $period = $request->get('period', 'alltime');

        $query = User::select('id', 'name', 'eco_score', 'co2_saved_this_month', 'trips_logged')
            ->orderBy('eco_score', 'desc');

        $leaders = $query->take(50)->get();

        // Assign ranks
        $leaders = $leaders->map(function ($user, $index) {
            $user->rank = $index + 1;
            // Generate avatar initials color
            $user->avatar_color = $this->getAvatarColor($user->name);
            return $user;
        });

        // Current user rank
        $currentUser = auth()->user();
        $userRank = User::where('eco_score', '>', $currentUser->eco_score)->count() + 1;
        $totalUsers = User::count();

        // Points to next rank
        $nextUser = User::where('eco_score', '>', $currentUser->eco_score)
            ->orderBy('eco_score')
            ->first();
        $pointsToNextRank = $nextUser ? $nextUser->eco_score - $currentUser->eco_score : 0;
        $nextRankPosition = $userRank > 1 ? $userRank - 1 : 1;

        return view('leaderboard.index', compact(
            'leaders', 'period', 'userRank', 'totalUsers', 'pointsToNextRank', 'nextRankPosition'
        ));
    }

    private function getAvatarColor(string $name): string
    {
        $colors = [
            '#00FF87', '#00C9A7', '#4ECDC4', '#45B7D1',
            '#96CEB4', '#FFEAA7', '#DDA0DD', '#98D8C8'
        ];
        $index = abs(crc32($name)) % count($colors);
        return $colors[$index];
    }
}

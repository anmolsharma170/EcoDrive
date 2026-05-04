<?php

namespace App\Http\Controllers;

use App\Models\Leaderboard;

class LeaderboardController extends Controller
{
    public function index()
    {
        $entries = Leaderboard::with('user')
            ->orderBy('rank')
            ->take(10)
            ->get();

        return view('leaderboard.index', compact('entries'));
    }
}

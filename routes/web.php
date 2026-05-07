<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EcoTipController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Route;

// Landing page (public)
Route::get('/', function () {
    $stats = [
        'total_co2_saved' => \App\Models\User::sum('co2_saved_this_month'),
        'total_trips'     => \App\Models\Trip::count(),
        'total_users'     => \App\Models\User::count(),
    ];
    return view('welcome', compact('stats'));
});

Route::view('/about', 'about')->name('about');
Route::view('/ev', 'ev')->name('ev');

// Authenticated routes
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Trips
    Route::resource('trips', TripController::class)->only(['index', 'create', 'store', 'destroy']);

    // Leaderboard
    Route::get('/leaderboard', [LeaderboardController::class, 'index'])->name('leaderboard.index');

    // Insights (Real Data)
    Route::view('/insights', 'insights.index')->name('insights.index');

    // Eco Tips
    Route::get('/eco-tips', [EcoTipController::class, 'index'])->name('eco-tips.index');

    // Vehicles
    Route::resource('vehicles', VehicleController::class)->only(['index', 'create', 'store', 'destroy']);

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

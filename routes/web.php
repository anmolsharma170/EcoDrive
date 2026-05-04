<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EcoTipController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Route;

// Welcome / Home
Route::get('/', function () {
    return view('welcome');
});

// Authenticated Routes
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile (Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Vehicle Manager
    Route::get('/vehicles',             [VehicleController::class, 'index'])->name('vehicles.index');
    Route::get('/vehicles/create',      [VehicleController::class, 'create'])->name('vehicles.create');
    Route::post('/vehicles',            [VehicleController::class, 'store'])->name('vehicles.store');
    Route::get('/vehicles/{vehicle}/edit',   [VehicleController::class, 'edit'])->name('vehicles.edit');
    Route::put('/vehicles/{vehicle}',        [VehicleController::class, 'update'])->name('vehicles.update');
    Route::delete('/vehicles/{vehicle}',     [VehicleController::class, 'destroy'])->name('vehicles.destroy');

    // Trip Logger
    Route::get('/trips',               [TripController::class, 'index'])->name('trips.index');
    Route::get('/trips/create',        [TripController::class, 'create'])->name('trips.create');
    Route::post('/trips',              [TripController::class, 'store'])->name('trips.store');
    Route::get('/trips/{trip}',        [TripController::class, 'show'])->name('trips.show');
    Route::delete('/trips/{trip}',     [TripController::class, 'destroy'])->name('trips.destroy');

    // Eco Tips
    Route::get('/tips',        [EcoTipController::class, 'index'])->name('tips.index');
    Route::get('/tips/{ecoTip}', [EcoTipController::class, 'show'])->name('tips.show');

    // Leaderboard
    Route::get('/leaderboard', [LeaderboardController::class, 'index'])->name('leaderboard.index');

    // Admin Panel
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard',          [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/users',              [AdminController::class, 'users'])->name('users');
        Route::delete('/users/{user}',    [AdminController::class, 'deleteUser'])->name('users.delete');
        Route::get('/tips',               [AdminController::class, 'tips'])->name('tips');
        Route::get('/tips/create',        [AdminController::class, 'createTip'])->name('tips.create');
        Route::post('/tips',              [AdminController::class, 'storeTip'])->name('tips.store');
        Route::get('/tips/{ecoTip}/edit', [AdminController::class, 'editTip'])->name('tips.edit');
        Route::put('/tips/{ecoTip}',      [AdminController::class, 'updateTip'])->name('tips.update');
        Route::delete('/tips/{ecoTip}',   [AdminController::class, 'deleteTip'])->name('tips.delete');
        Route::get('/trips',              [AdminController::class, 'allTrips'])->name('trips');
    });
});

require __DIR__.'/auth.php';

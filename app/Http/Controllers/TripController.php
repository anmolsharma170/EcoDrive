<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\Trip;
use App\Models\UserStreak;
use Illuminate\Http\Request;

class TripController extends Controller
{
    public function index()
    {
        $trips = Trip::where('user_id', auth()->id())
            ->orderBy('date', 'desc')
            ->paginate(10);

        return view('trips.index', compact('trips'));
    }

    public function create()
    {
        $vehicles = auth()->user()->vehicles;
        return view('trips.create', compact('vehicles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'distance_km'   => 'required|numeric|min:0.1|max:5000',
            'fuel_type'     => 'required|in:petrol,diesel,electric,hybrid,cng',
            'vehicle_type'  => 'required|string',
            'date'          => 'required|date|before_or_equal:today',
            'notes'         => 'nullable|string|max:500',
            'vehicle_id'    => 'nullable|exists:vehicles,id',
        ]);

        // CO2 calculation based on fuel type (kg per km)
        $emissionFactors = [
            'petrol'   => 0.21,
            'diesel'   => 0.27,
            'electric' => 0.05,
            'hybrid'   => 0.10,
            'cng'      => 0.18,
        ];

        $factor = $emissionFactors[$validated['fuel_type']] ?? 0.21;
        $co2Emitted = round($validated['distance_km'] * $factor, 2);

        $trip = Trip::create([
            'user_id'       => auth()->id(),
            'vehicle_id'    => $validated['vehicle_id'] ?? null,
            'distance_km'   => $validated['distance_km'],
            'co2_emitted_kg'=> $co2Emitted,
            'date'          => $validated['date'],
            'fuel_type'     => $validated['fuel_type'],
            'vehicle_type'  => $validated['vehicle_type'],
            'notes'         => $validated['notes'] ?? null,
        ]);

        // Update user stats
        $user = auth()->user();
        $user->increment('trips_logged');

        // Update eco score (lower CO2 = more points)
        $pointsEarned = max(0, (int)(50 - ($co2Emitted * 5)));
        $user->increment('eco_score', $pointsEarned);

        // Update streak
        UserStreak::updateForUser($user);

        // Check achievements
        $this->checkAchievements($user, $trip);

        return redirect()->route('trips.index')
            ->with('success', "Trip logged! You emitted {$co2Emitted}kg CO2 — that's like burning " . round($co2Emitted / 2.42, 2) . "kg of coal.");
    }

    public function destroy(Trip $trip)
    {
        if ($trip->user_id !== auth()->id()) {
            abort(403);
        }
        $trip->delete();
        return back()->with('success', 'Trip deleted.');
    }

    private function checkAchievements($user, $trip): void
    {
        $totalTrips = $user->trips_logged;
        $totalKm = Trip::where('user_id', $user->id)->sum('distance_km');
        $userAchievementIds = $user->achievements()->pluck('achievements.id')->toArray();

        $toUnlock = [];

        // First Trip
        if ($totalTrips >= 1) {
            $a = Achievement::where('slug', 'first-trip')->first();
            if ($a && !in_array($a->id, $userAchievementIds)) $toUnlock[] = $a->id;
        }

        // 10 Trips
        if ($totalTrips >= 10) {
            $a = Achievement::where('slug', '10-trips')->first();
            if ($a && !in_array($a->id, $userAchievementIds)) $toUnlock[] = $a->id;
        }

        // 100 km Club
        if ($totalKm >= 100) {
            $a = Achievement::where('slug', '100km-club')->first();
            if ($a && !in_array($a->id, $userAchievementIds)) $toUnlock[] = $a->id;
        }

        // Low Emitter: trip < 1kg CO2
        if ($trip->co2_emitted_kg < 1) {
            $a = Achievement::where('slug', 'low-emitter')->first();
            if ($a && !in_array($a->id, $userAchievementIds)) $toUnlock[] = $a->id;
        }

        // Electric Pioneer
        if ($trip->fuel_type === 'electric') {
            $a = Achievement::where('slug', 'electric-pioneer')->first();
            if ($a && !in_array($a->id, $userAchievementIds)) $toUnlock[] = $a->id;
        }

        if (!empty($toUnlock)) {
            $pivotData = [];
            foreach ($toUnlock as $achievementId) {
                $pivotData[$achievementId] = ['unlocked_at' => now()];
            }
            $user->achievements()->syncWithoutDetaching($pivotData);
        }
    }
}

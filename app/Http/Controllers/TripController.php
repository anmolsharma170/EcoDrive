<?php

namespace App\Http\Controllers;

use App\Models\CarbonStandard;
use App\Models\Leaderboard;
use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TripController extends Controller
{
    public function index()
    {
        $trips = Auth::user()->trips()
            ->with('vehicle')
            ->orderByDesc('trip_date')
            ->paginate(10);

        return view('trips.index', compact('trips'));
    }

    public function create()
    {
        $vehicles = Auth::user()->vehicles()->get();

        if ($vehicles->isEmpty()) {
            return redirect()->route('vehicles.create')
                ->with('warning', 'Please add a vehicle before logging a trip.');
        }

        return view('trips.create', compact('vehicles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'vehicle_id'   => 'required|exists:vehicles,id',
            'distance_km'  => 'required|numeric|min:0.1|max:10000',
            'fuel_consumed'=> 'required|numeric|min:0.01|max:1000',
            'trip_date'    => 'required|date|before_or_equal:today',
        ]);

        // Ownership check
        $vehicle = Auth::user()->vehicles()->findOrFail($validated['vehicle_id']);

        // Carbon emission calculation
        $carbonStandard = CarbonStandard::where('fuel_type', $vehicle->fuel_type)->firstOrFail();
        $carbonEmission = round($validated['fuel_consumed'] * $carbonStandard->emission_factor, 4);
        $ecoPoints      = $carbonEmission > 0
            ? round($validated['distance_km'] / $carbonEmission, 4)
            : 0;

        $trip = Trip::create([
            'user_id'           => Auth::id(),
            'vehicle_id'        => $vehicle->id,
            'distance_km'       => $validated['distance_km'],
            'fuel_consumed'     => $validated['fuel_consumed'],
            'carbon_emission'   => $carbonEmission,
            'eco_points_earned' => $ecoPoints,
            'trip_date'         => $validated['trip_date'],
        ]);

        // Update user eco_score
        $user = Auth::user();
        $user->increment('eco_score', $ecoPoints);

        // Update or create leaderboard entry
        $lb = Leaderboard::firstOrNew(['user_id' => $user->id]);
        $lb->total_eco_score = ($lb->total_eco_score ?? 0) + $ecoPoints;
        $lb->total_trips     = ($lb->total_trips ?? 0) + 1;
        $lb->total_co2_saved = ($lb->total_co2_saved ?? 0) + $carbonEmission;
        $lb->updated_at      = now();
        $lb->save();

        // Re-rank all leaderboard entries
        $entries = Leaderboard::orderByDesc('total_eco_score')->get();
        foreach ($entries as $rank => $entry) {
            $entry->rank = $rank + 1;
            $entry->save();
        }

        return redirect()->route('trips.show', $trip)
            ->with('success', 'Trip logged! You earned ' . number_format($ecoPoints, 2) . ' eco points.');
    }

    public function show(Trip $trip)
    {
        if ($trip->user_id !== Auth::id()) {
            abort(403);
        }

        $trip->load('vehicle');
        return view('trips.show', compact('trip'));
    }

    public function destroy(Trip $trip)
    {
        if ($trip->user_id !== Auth::id()) {
            abort(403);
        }

        $ecoPoints = $trip->eco_points_earned;
        $co2       = $trip->carbon_emission;
        $trip->delete();

        // Update user eco_score
        $user = Auth::user();
        $user->decrement('eco_score', $ecoPoints);

        // Update leaderboard
        $lb = Leaderboard::where('user_id', $user->id)->first();
        if ($lb) {
            $lb->total_eco_score = max(0, $lb->total_eco_score - $ecoPoints);
            $lb->total_trips     = max(0, $lb->total_trips - 1);
            $lb->total_co2_saved = max(0, $lb->total_co2_saved - $co2);
            $lb->updated_at      = now();
            $lb->save();
        }

        return redirect()->route('trips.index')
            ->with('success', 'Trip deleted.');
    }
}

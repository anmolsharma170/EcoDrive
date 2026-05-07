<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::where('user_id', auth()->id())->get();
        return view('vehicles.index', compact('vehicles'));
    }

    public function create()
    {
        return view('vehicles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'make'            => 'required|string|max:100',
            'model'           => 'required|string|max:100',
            'year'            => 'required|integer|min:1990|max:' . (date('Y') + 1),
            'fuel_type'       => 'required|in:petrol,diesel,electric,hybrid,cng',
            'engine_cc'       => 'nullable|numeric|min:0',
            'co2_per_km'      => 'required|numeric|min:0|max:999',
            'emission_rating' => 'required|in:A++,A+,A,B,C,D,E,F',
            'is_primary'      => 'boolean',
        ]);

        if ($request->boolean('is_primary')) {
            Vehicle::where('user_id', auth()->id())->update(['is_primary' => false]);
        }

        Vehicle::create(array_merge($validated, ['user_id' => auth()->id()]));

        return redirect()->route('vehicles.index')->with('success', 'Vehicle added successfully!');
    }

    public function destroy(Vehicle $vehicle)
    {
        if ($vehicle->user_id !== auth()->id()) abort(403);
        $vehicle->delete();
        return back()->with('success', 'Vehicle removed.');
    }
}

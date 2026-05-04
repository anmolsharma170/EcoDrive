<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Auth::user()->vehicles()->latest()->get();
        return view('vehicles.index', compact('vehicles'));
    }

    public function create()
    {
        return view('vehicles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'vehicle_name' => 'required|string|max:100',
            'vehicle_type' => 'required|in:car,bike,truck',
            'fuel_type'    => 'required|in:petrol,diesel,electric,hybrid',
        ]);

        Auth::user()->vehicles()->create($validated);

        return redirect()->route('vehicles.index')
            ->with('success', 'Vehicle added successfully!');
    }

    public function edit(Vehicle $vehicle)
    {
        $this->authorizeVehicle($vehicle);
        return view('vehicles.edit', compact('vehicle'));
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        $this->authorizeVehicle($vehicle);

        $validated = $request->validate([
            'vehicle_name' => 'required|string|max:100',
            'vehicle_type' => 'required|in:car,bike,truck',
            'fuel_type'    => 'required|in:petrol,diesel,electric,hybrid',
        ]);

        $vehicle->update($validated);

        return redirect()->route('vehicles.index')
            ->with('success', 'Vehicle updated successfully!');
    }

    public function destroy(Vehicle $vehicle)
    {
        $this->authorizeVehicle($vehicle);
        $vehicle->delete();

        return redirect()->route('vehicles.index')
            ->with('success', 'Vehicle deleted.');
    }

    private function authorizeVehicle(Vehicle $vehicle): void
    {
        if ($vehicle->user_id !== Auth::id()) {
            abort(403);
        }
    }
}

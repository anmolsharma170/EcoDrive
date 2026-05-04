<?php

namespace App\Http\Controllers;

use App\Models\EcoTip;
use App\Models\Leaderboard;
use App\Models\Trip;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalUsers  = User::where('role', 'user')->count();
        $totalTrips  = Trip::count();
        $totalCo2    = Trip::sum('carbon_emission');
        $totalPoints = Trip::sum('eco_points_earned');

        $recentTrips = Trip::with(['user', 'vehicle'])
            ->orderByDesc('created_at')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalUsers', 'totalTrips', 'totalCo2', 'totalPoints', 'recentTrips'
        ));
    }

    public function users()
    {
        $users = User::withCount('trips')
            ->orderByDesc('eco_score')
            ->paginate(15);

        return view('admin.users', compact('users'));
    }

    public function deleteUser(User $user)
    {
        if ($user->role === 'admin') {
            return back()->with('error', 'Cannot delete admin users.');
        }
        $user->delete();
        return back()->with('success', 'User deleted.');
    }

    public function tips()
    {
        $tips = EcoTip::orderByDesc('created_at')->paginate(15);
        return view('admin.tips', compact('tips'));
    }

    public function createTip()
    {
        return view('admin.tips-form', ['tip' => null]);
    }

    public function storeTip(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:200',
            'description' => 'required|string',
            'category'    => 'required|in:driving,maintenance,fuel',
            'image_url'   => 'nullable|url',
            'is_active'   => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        EcoTip::create($validated);

        return redirect()->route('admin.tips')
            ->with('success', 'Eco tip created!');
    }

    public function editTip(EcoTip $ecoTip)
    {
        return view('admin.tips-form', ['tip' => $ecoTip]);
    }

    public function updateTip(Request $request, EcoTip $ecoTip)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:200',
            'description' => 'required|string',
            'category'    => 'required|in:driving,maintenance,fuel',
            'image_url'   => 'nullable|url',
            'is_active'   => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $ecoTip->update($validated);

        return redirect()->route('admin.tips')
            ->with('success', 'Eco tip updated!');
    }

    public function deleteTip(EcoTip $ecoTip)
    {
        $ecoTip->delete();
        return back()->with('success', 'Eco tip deleted.');
    }

    public function allTrips()
    {
        $trips = Trip::with(['user', 'vehicle'])
            ->orderByDesc('trip_date')
            ->paginate(15);

        return view('admin.trips', compact('trips'));
    }
}

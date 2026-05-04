@extends('layouts.app')

@section('title', 'Trip Logger')

@section('content')
<div class="page-header d-flex align-items-center justify-content-between">
    <div>
        <h1>Trip Logger</h1>
        <p>All your logged trips and emission records.</p>
    </div>
    <a href="{{ route('trips.create') }}" class="btn-eco btn">
        <i class="bi bi-plus-lg me-1"></i> Log New Trip
    </a>
</div>

@if($trips->isEmpty())
<div class="eco-card text-center py-5">
    <i class="bi bi-map" style="font-size:3.5rem; color:var(--eco-muted);"></i>
    <h5 class="mt-3" style="color:var(--eco-muted);">No trips logged yet</h5>
    <a href="{{ route('trips.create') }}" class="btn-eco btn mt-2">Log Your First Trip</a>
</div>
@else
<div class="eco-card">
    <table class="eco-table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Vehicle</th>
                <th>Distance</th>
                <th>Fuel Used</th>
                <th>CO₂ Emitted</th>
                <th>Eco Points</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($trips as $trip)
            <tr>
                <td>{{ $trip->trip_date->format('M d, Y') }}</td>
                <td>
                    <div style="font-weight:500;">{{ $trip->vehicle->vehicle_name ?? 'N/A' }}</div>
                    <div style="font-size:.75rem; color:var(--eco-muted);">{{ ucfirst($trip->vehicle->fuel_type ?? '') }}</div>
                </td>
                <td>{{ $trip->distance_km }} km</td>
                <td>{{ $trip->fuel_consumed }} L</td>
                <td><span class="badge-yellow">{{ number_format($trip->carbon_emission, 2) }} kg</span></td>
                <td><span class="badge-green">+{{ number_format($trip->eco_points_earned, 2) }}</span></td>
                <td>
                    <div class="d-flex gap-1">
                        <a href="{{ route('trips.show', $trip) }}" class="btn btn-sm" style="background:rgba(59,130,246,.15); color:#60a5fa; border-radius:8px;" title="View">
                            <i class="bi bi-eye"></i>
                        </a>
                        <form method="POST" action="{{ route('trips.destroy', $trip) }}" onsubmit="return confirm('Delete this trip?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger-eco" title="Delete"><i class="bi bi-trash"></i></button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-3">{{ $trips->links() }}</div>
</div>
@endif
@endsection

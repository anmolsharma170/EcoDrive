@extends('layouts.app')

@section('title', 'All Trips')

@section('content')
<div class="page-header">
    <h1>All Trips</h1>
    <p>Platform-wide trip log across all users.</p>
</div>

<div class="eco-card">
    <table class="eco-table">
        <thead>
            <tr>
                <th>Date</th>
                <th>User</th>
                <th>Vehicle</th>
                <th>Distance</th>
                <th>Fuel</th>
                <th>CO₂ (kg)</th>
                <th>Eco Points</th>
            </tr>
        </thead>
        <tbody>
            @foreach($trips as $trip)
            <tr>
                <td style="color:var(--eco-muted); font-size:.85rem;">{{ $trip->trip_date->format('M d, Y') }}</td>
                <td style="font-weight:500;">{{ $trip->user->name ?? '—' }}</td>
                <td>
                    <div>{{ $trip->vehicle->vehicle_name ?? '—' }}</div>
                    <div style="font-size:.75rem; color:var(--eco-muted);">{{ ucfirst($trip->vehicle->fuel_type ?? '') }}</div>
                </td>
                <td>{{ $trip->distance_km }} km</td>
                <td>{{ $trip->fuel_consumed }} L</td>
                <td><span class="badge-yellow">{{ number_format($trip->carbon_emission, 2) }}</span></td>
                <td><span class="badge-green">+{{ number_format($trip->eco_points_earned, 2) }}</span></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-3">{{ $trips->links() }}</div>
</div>
@endsection

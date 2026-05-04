@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="page-header">
    <h1><i class="bi bi-shield-check me-2" style="color:var(--eco-green);"></i>Admin Dashboard</h1>
    <p>Platform overview and management.</p>
</div>

<!-- Stats -->
<div class="row g-3 mb-4">
    @php
    $adminStats = [
        ['label'=>'Total Users',    'value'=>$totalUsers,  'icon'=>'bi-people-fill',    'color'=>'#60a5fa', 'bg'=>'rgba(59,130,246,.15)'],
        ['label'=>'Total Trips',    'value'=>$totalTrips,  'icon'=>'bi-map-fill',       'color'=>'#22c55e', 'bg'=>'rgba(34,197,94,.15)'],
        ['label'=>'Total CO₂ (kg)', 'value'=>number_format($totalCo2,1), 'icon'=>'bi-cloud-fill', 'color'=>'#f87171', 'bg'=>'rgba(239,68,68,.15)'],
        ['label'=>'Total Eco Points','value'=>number_format($totalPoints,0), 'icon'=>'bi-star-fill', 'color'=>'#fbbf24', 'bg'=>'rgba(234,179,8,.15)'],
    ];
    @endphp
    @foreach($adminStats as $stat)
    <div class="col-md-3">
        <div class="eco-card">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <div style="background:{{ $stat['bg'] }}; border-radius:12px; padding:.7rem; color:{{ $stat['color'] }}; font-size:1.3rem;">
                    <i class="bi {{ $stat['icon'] }}"></i>
                </div>
            </div>
            <div class="stat-value">{{ $stat['value'] }}</div>
            <div class="stat-label">{{ $stat['label'] }}</div>
        </div>
    </div>
    @endforeach
</div>

<!-- Quick Links + Recent Trips -->
<div class="row g-3">
    <div class="col-md-4">
        <div class="eco-card h-100">
            <h6 style="font-weight:600; margin-bottom:1rem;">Admin Actions</h6>
            @foreach([
                ['route'=>'admin.users',    'icon'=>'bi-people',        'label'=>'Manage Users',    'color'=>'#60a5fa'],
                ['route'=>'admin.tips',     'icon'=>'bi-lightbulb',     'label'=>'Manage Eco Tips', 'color'=>'#22c55e'],
                ['route'=>'admin.trips',    'icon'=>'bi-map',           'label'=>'View All Trips',  'color'=>'#fbbf24'],
                ['route'=>'admin.tips.create','icon'=>'bi-plus-circle', 'label'=>'Add New Tip',    'color'=>'#c084fc'],
            ] as $action)
            <a href="{{ route($action['route']) }}" class="d-flex align-items-center gap-3 p-2 mb-1 text-decoration-none" style="border-radius:10px; transition:background .2s;" onmouseover="this.style.background='rgba(255,255,255,.04)'" onmouseout="this.style.background='transparent'">
                <div style="background:rgba(255,255,255,.06); border-radius:8px; padding:.5rem; color:{{ $action['color'] }};">
                    <i class="bi {{ $action['icon'] }}"></i>
                </div>
                <span style="font-size:.9rem; color:var(--eco-text); font-weight:500;">{{ $action['label'] }}</span>
                <i class="bi bi-chevron-right ms-auto" style="color:var(--eco-muted); font-size:.75rem;"></i>
            </a>
            @endforeach
        </div>
    </div>

    <div class="col-md-8">
        <div class="eco-card h-100">
            <h6 style="font-weight:600; margin-bottom:1rem;">Recent Trips</h6>
            <table class="eco-table">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Vehicle</th>
                        <th>Distance</th>
                        <th>CO₂</th>
                        <th>Points</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentTrips as $trip)
                    <tr>
                        <td style="font-weight:500;">{{ $trip->user->name ?? '—' }}</td>
                        <td style="color:var(--eco-muted); font-size:.85rem;">{{ $trip->vehicle->vehicle_name ?? '—' }}</td>
                        <td>{{ $trip->distance_km }} km</td>
                        <td><span class="badge-yellow">{{ number_format($trip->carbon_emission,2) }} kg</span></td>
                        <td><span class="badge-green">+{{ number_format($trip->eco_points_earned,2) }}</span></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

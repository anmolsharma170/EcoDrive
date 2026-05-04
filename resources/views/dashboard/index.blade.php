@extends('layouts.app')

@section('title', 'Dashboard')

@push('styles')
<style>
.chart-container { position: relative; height: 220px; }
.eco-score-display {
    font-size: 3rem; font-weight: 800;
    background: linear-gradient(135deg, #22c55e, #16a34a);
    -webkit-background-clip: text; -webkit-text-fill-color: transparent;
}
.stat-icon-green  { background: rgba(34,197,94,.15);  color: #22c55e; }
.stat-icon-blue   { background: rgba(59,130,246,.15); color: #60a5fa; }
.stat-icon-yellow { background: rgba(234,179,8,.15);  color: #fbbf24; }
.stat-icon-purple { background: rgba(168,85,247,.15); color: #c084fc; }
</style>
@endpush

@section('content')
<div class="page-header">
    <h1>Welcome back, {{ Auth::user()->name }}! 👋</h1>
    <p>Here's your eco-driving performance overview.</p>
</div>

<!-- Stat Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="eco-card h-100">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div class="stat-icon-green stat-card-icon"><i class="bi bi-star-fill"></i></div>
                <span class="badge-green">Eco Score</span>
            </div>
            <div class="eco-score-display">{{ number_format($ecoScore, 0) }}</div>
            <div class="stat-label mt-1">Total Eco Points Earned</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="eco-card h-100">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div class="stat-icon-blue stat-card-icon"><i class="bi bi-map-fill"></i></div>
                <span class="badge-blue">Trips</span>
            </div>
            <div class="stat-value">{{ $totalTrips }}</div>
            <div class="stat-label mt-1">Total Trips Logged</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="eco-card h-100">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div class="stat-icon-yellow stat-card-icon"><i class="bi bi-cloud-fill"></i></div>
                <span class="badge-yellow">CO₂</span>
            </div>
            <div class="stat-value">{{ number_format($totalCo2, 1) }}</div>
            <div class="stat-label mt-1">kg CO₂ Emitted (all trips)</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="eco-card h-100">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div class="stat-icon-purple stat-card-icon"><i class="bi bi-trophy-fill"></i></div>
                <span class="badge-green">Rank</span>
            </div>
            <div class="stat-value">#{{ $userRank }}</div>
            <div class="stat-label mt-1">Your Leaderboard Rank</div>
        </div>
    </div>
</div>

<!-- Chart + Recent Trips -->
<div class="row g-3">
    <div class="col-lg-7">
        <div class="eco-card h-100">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h6 class="mb-0 fw-600" style="font-weight:600;">Eco Points — Last 7 Trips</h6>
                <a href="{{ route('trips.create') }}" class="btn-eco btn btn-sm">
                    <i class="bi bi-plus-lg"></i> Log Trip
                </a>
            </div>
            @if($recentTrips->isEmpty())
            <div class="text-center py-5" style="color:var(--eco-muted);">
                <i class="bi bi-map" style="font-size:3rem;"></i>
                <p class="mt-2">No trips yet. <a href="{{ route('trips.create') }}" style="color:var(--eco-green);">Log your first trip!</a></p>
            </div>
            @else
            <div class="chart-container">
                <canvas id="ecoChart"></canvas>
            </div>
            @endif
        </div>
    </div>

    <div class="col-lg-5">
        <div class="eco-card h-100">
            <h6 class="mb-3" style="font-weight:600;">Recent Trips</h6>
            @if($recentTrips->isEmpty())
            <p style="color:var(--eco-muted); font-size:.9rem;">No trips recorded yet.</p>
            @else
            @foreach($recentTrips->sortByDesc('trip_date') as $trip)
            <div class="d-flex align-items-center gap-3 mb-3 pb-3" style="border-bottom:1px solid rgba(255,255,255,.05);">
                <div style="background:rgba(34,197,94,.1); border-radius:10px; padding:.6rem; color:var(--eco-green);">
                    <i class="bi bi-car-front-fill"></i>
                </div>
                <div class="flex-grow-1">
                    <div style="font-size:.85rem; font-weight:500;">{{ $trip->vehicle->vehicle_name ?? 'N/A' }}</div>
                    <div style="font-size:.75rem; color:var(--eco-muted);">{{ $trip->distance_km }} km • {{ $trip->trip_date->format('M d') }}</div>
                </div>
                <div class="text-end">
                    <div style="font-size:.9rem; font-weight:600; color:var(--eco-green);">+{{ number_format($trip->eco_points_earned, 1) }}</div>
                    <div style="font-size:.7rem; color:var(--eco-muted);">pts</div>
                </div>
            </div>
            @endforeach
            @endif
            <a href="{{ route('trips.index') }}" style="color:var(--eco-green); font-size:.82rem;">View all trips →</a>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row g-3 mt-3">
    <div class="col-md-4">
        <a href="{{ route('trips.create') }}" class="eco-card d-block text-decoration-none" style="text-align:center; padding:1.5rem;">
            <i class="bi bi-plus-circle-fill" style="font-size:2rem; color:var(--eco-green);"></i>
            <div class="mt-2" style="font-weight:600;">Log New Trip</div>
            <div style="color:var(--eco-muted); font-size:.82rem;">Track your emissions</div>
        </a>
    </div>
    <div class="col-md-4">
        <a href="{{ route('leaderboard.index') }}" class="eco-card d-block text-decoration-none" style="text-align:center; padding:1.5rem;">
            <i class="bi bi-trophy-fill" style="font-size:2rem; color:#fbbf24;"></i>
            <div class="mt-2" style="font-weight:600;">Leaderboard</div>
            <div style="color:var(--eco-muted); font-size:.82rem;">See top eco drivers</div>
        </a>
    </div>
    <div class="col-md-4">
        <a href="{{ route('tips.index') }}" class="eco-card d-block text-decoration-none" style="text-align:center; padding:1.5rem;">
            <i class="bi bi-lightbulb-fill" style="font-size:2rem; color:#60a5fa;"></i>
            <div class="mt-2" style="font-weight:600;">Eco Tips</div>
            <div style="color:var(--eco-muted); font-size:.82rem;">Improve your score</div>
        </a>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
@if(!$recentTrips->isEmpty())
const ctx = document.getElementById('ecoChart').getContext('2d');
new Chart(ctx, {
    type: 'line',
    data: {
        labels: {!! json_encode($chartLabels) !!},
        datasets: [{
            label: 'Eco Points',
            data: {!! json_encode($chartData) !!},
            borderColor: '#22c55e',
            backgroundColor: 'rgba(34,197,94,0.1)',
            borderWidth: 2.5,
            pointBackgroundColor: '#22c55e',
            pointRadius: 4,
            fill: true,
            tension: 0.4,
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
            x: { grid: { color: 'rgba(255,255,255,0.05)' }, ticks: { color: '#94a3b8', font: { size: 11 } } },
            y: { grid: { color: 'rgba(255,255,255,0.05)' }, ticks: { color: '#94a3b8', font: { size: 11 } } }
        }
    }
});
@endif
</script>
@endpush

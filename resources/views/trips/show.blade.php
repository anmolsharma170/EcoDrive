@extends('layouts.app')

@section('title', 'Trip Details')

@section('content')
<div class="page-header">
    <h1>Trip Details</h1>
    <p>{{ $trip->trip_date->format('F d, Y') }}</p>
</div>

<div class="row justify-content-center">
    <div class="col-lg-7">
        <!-- Eco Points Card -->
        <div class="eco-card mb-3 text-center" style="background: linear-gradient(135deg, rgba(34,197,94,.15), rgba(22,163,74,.08)); border-color: rgba(34,197,94,.2);">
            <div style="font-size:.85rem; color:var(--eco-muted);">Eco Points Earned</div>
            <div style="font-size:3.5rem; font-weight:800; background:linear-gradient(135deg,#22c55e,#16a34a); -webkit-background-clip:text; -webkit-text-fill-color:transparent;">
                +{{ number_format($trip->eco_points_earned, 2) }}
            </div>
            <div style="font-size:.82rem; color:var(--eco-muted);">Added to your eco score</div>
        </div>

        <div class="eco-card">
            <h6 style="font-weight:600; margin-bottom:1.2rem; color:var(--eco-muted);">TRIP OVERVIEW</h6>
            <div class="row g-3">
                @php
                $stats = [
                    ['label'=>'Vehicle',      'value'=>$trip->vehicle->vehicle_name ?? 'N/A', 'icon'=>'bi-car-front-fill', 'color'=>'#60a5fa'],
                    ['label'=>'Fuel Type',    'value'=>ucfirst($trip->vehicle->fuel_type ?? 'N/A'), 'icon'=>'bi-fuel-pump-fill', 'color'=>'#fbbf24'],
                    ['label'=>'Distance',     'value'=>$trip->distance_km.' km', 'icon'=>'bi-map-fill', 'color'=>'#22c55e'],
                    ['label'=>'Fuel Used',    'value'=>$trip->fuel_consumed.' L', 'icon'=>'bi-droplet-fill', 'color'=>'#94a3b8'],
                    ['label'=>'CO₂ Emitted',  'value'=>number_format($trip->carbon_emission,4).' kg', 'icon'=>'bi-cloud-fill', 'color'=>'#f87171'],
                    ['label'=>'Trip Date',    'value'=>$trip->trip_date->format('M d, Y'), 'icon'=>'bi-calendar-event', 'color'=>'#c084fc'],
                ];
                @endphp
                @foreach($stats as $stat)
                <div class="col-md-6">
                    <div style="background:rgba(255,255,255,.04); border-radius:12px; padding:1rem; display:flex; align-items:center; gap:.8rem;">
                        <div style="background:rgba(255,255,255,.06); border-radius:10px; padding:.5rem; font-size:1.1rem; color:{{ $stat['color'] }};">
                            <i class="bi {{ $stat['icon'] }}"></i>
                        </div>
                        <div>
                            <div style="font-size:.72rem; color:var(--eco-muted); text-transform:uppercase; letter-spacing:.06em;">{{ $stat['label'] }}</div>
                            <div style="font-weight:600; font-size:.95rem;">{{ $stat['value'] }}</div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="d-flex gap-2 mt-4">
                <a href="{{ route('trips.index') }}" class="btn-eco btn">
                    <i class="bi bi-arrow-left me-1"></i> Back to Trips
                </a>
                <form method="POST" action="{{ route('trips.destroy', $trip) }}" onsubmit="return confirm('Delete this trip? Your eco score will be adjusted.')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger-eco">
                        <i class="bi bi-trash me-1"></i> Delete Trip
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

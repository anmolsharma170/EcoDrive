@extends('layouts.app')

@section('title', 'Log a Trip')

@section('content')
<div class="page-header">
    <h1>Log a Trip</h1>
    <p>Enter your trip details to calculate carbon emissions and earn eco points.</p>
</div>

<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="eco-card">
            <!-- Emission Info Banner -->
            <div style="background:rgba(34,197,94,.07); border:1px solid rgba(34,197,94,.15); border-radius:12px; padding:1rem 1.2rem; margin-bottom:1.5rem;">
                <div style="font-size:.82rem; color:var(--eco-green); font-weight:600; margin-bottom:.3rem;">
                    <i class="bi bi-info-circle-fill me-1"></i> How Points Are Calculated
                </div>
                <div style="font-size:.8rem; color:var(--eco-muted);">
                    <strong style="color:var(--eco-text);">CO₂ Emission</strong> = Fuel Consumed × Emission Factor (kg/L)<br>
                    <strong style="color:var(--eco-text);">Eco Points</strong> = Distance ÷ CO₂ Emission &nbsp;|&nbsp; Higher efficiency = more points!
                </div>
            </div>

            <form method="POST" action="{{ route('trips.store') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Vehicle</label>
                    <select name="vehicle_id" class="form-select @error('vehicle_id') is-invalid @enderror">
                        <option value="">Select your vehicle...</option>
                        @foreach($vehicles as $vehicle)
                        <option value="{{ $vehicle->id }}" {{ old('vehicle_id') == $vehicle->id ? 'selected' : '' }}>
                            {{ $vehicle->vehicle_name }} ({{ ucfirst($vehicle->fuel_type) }})
                        </option>
                        @endforeach
                    </select>
                    @error('vehicle_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Distance (km)</label>
                        <input type="number" name="distance_km" step="0.1" min="0.1"
                            class="form-control @error('distance_km') is-invalid @enderror"
                            value="{{ old('distance_km') }}" placeholder="25.5">
                        @error('distance_km')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Fuel Consumed (litres / kWh)</label>
                        <input type="number" name="fuel_consumed" step="0.01" min="0.01"
                            class="form-control @error('fuel_consumed') is-invalid @enderror"
                            value="{{ old('fuel_consumed') }}" placeholder="2.5">
                        @error('fuel_consumed')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label">Trip Date</label>
                    <input type="date" name="trip_date"
                        class="form-control @error('trip_date') is-invalid @enderror"
                        value="{{ old('trip_date', date('Y-m-d')) }}" max="{{ date('Y-m-d') }}">
                    @error('trip_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn-eco btn">
                        <i class="bi bi-check-lg me-1"></i> Calculate & Save Trip
                    </button>
                    <a href="{{ route('trips.index') }}" class="btn" style="background:rgba(255,255,255,.06); color:var(--eco-text); border-radius:10px;">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

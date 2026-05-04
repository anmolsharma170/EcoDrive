@extends('layouts.app')

@section('title', 'Edit Vehicle')

@section('content')
<div class="page-header">
    <h1>Edit Vehicle</h1>
    <p>Update your vehicle details.</p>
</div>

<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="eco-card">
            <form method="POST" action="{{ route('vehicles.update', $vehicle) }}">
                @csrf @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Vehicle Name</label>
                    <input type="text" name="vehicle_name" class="form-control @error('vehicle_name') is-invalid @enderror"
                        value="{{ old('vehicle_name', $vehicle->vehicle_name) }}" placeholder="e.g. Honda City">
                    @error('vehicle_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Vehicle Type</label>
                    <select name="vehicle_type" class="form-select">
                        @foreach(['car'=>'🚗 Car','bike'=>'🏍️ Bike','truck'=>'🚛 Truck'] as $val => $label)
                        <option value="{{ $val }}" {{ old('vehicle_type', $vehicle->vehicle_type) === $val ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label class="form-label">Fuel Type</label>
                    <select name="fuel_type" class="form-select">
                        @foreach(['petrol'=>'⛽ Petrol','diesel'=>'🛢️ Diesel','electric'=>'⚡ Electric','hybrid'=>'🔋 Hybrid'] as $val => $label)
                        <option value="{{ $val }}" {{ old('fuel_type', $vehicle->fuel_type) === $val ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn-eco btn">Save Changes</button>
                    <a href="{{ route('vehicles.index') }}" class="btn" style="background:rgba(255,255,255,.06); color:var(--eco-text); border-radius:10px;">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

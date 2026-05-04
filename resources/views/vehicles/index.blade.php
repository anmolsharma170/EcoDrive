@extends('layouts.app')

@section('title', 'My Vehicles')

@section('content')
<div class="page-header d-flex align-items-center justify-content-between">
    <div>
        <h1>My Vehicles</h1>
        <p>Manage your vehicles for accurate emission tracking.</p>
    </div>
    <a href="{{ route('vehicles.create') }}" class="btn-eco btn">
        <i class="bi bi-plus-lg me-1"></i> Add Vehicle
    </a>
</div>

@if($vehicles->isEmpty())
<div class="eco-card text-center py-5">
    <i class="bi bi-car-front" style="font-size:3.5rem; color:var(--eco-muted);"></i>
    <h5 class="mt-3" style="color:var(--eco-muted);">No vehicles yet</h5>
    <p style="color:var(--eco-muted); font-size:.9rem;">Add your first vehicle to start logging trips.</p>
    <a href="{{ route('vehicles.create') }}" class="btn-eco btn mt-2">Add Vehicle</a>
</div>
@else
<div class="row g-3">
    @foreach($vehicles as $vehicle)
    <div class="col-md-4">
        <div class="eco-card h-100">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div style="background:rgba(34,197,94,.1); border-radius:12px; padding:.8rem; color:var(--eco-green); font-size:1.5rem;">
                    @if($vehicle->vehicle_type === 'bike')
                    <i class="bi bi-bicycle"></i>
                    @elseif($vehicle->vehicle_type === 'truck')
                    <i class="bi bi-truck"></i>
                    @else
                    <i class="bi bi-car-front-fill"></i>
                    @endif
                </div>
                <div class="d-flex gap-1">
                    <a href="{{ route('vehicles.edit', $vehicle) }}" class="btn btn-sm" style="background:rgba(59,130,246,.15); color:#60a5fa; border-radius:8px;">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <form method="POST" action="{{ route('vehicles.destroy', $vehicle) }}" onsubmit="return confirm('Delete this vehicle?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger-eco"><i class="bi bi-trash"></i></button>
                    </form>
                </div>
            </div>
            <h6 style="font-weight:700; font-size:1rem; margin-bottom:.5rem;">{{ $vehicle->vehicle_name }}</h6>
            <div class="d-flex gap-2 flex-wrap mt-2">
                <span class="badge-blue">{{ ucfirst($vehicle->vehicle_type) }}</span>
                @php
                $fuelColors = ['petrol'=>'badge-yellow','diesel'=>'badge-red','electric'=>'badge-green','hybrid'=>'badge-blue'];
                $fuelColor = $fuelColors[$vehicle->fuel_type] ?? 'badge-blue';
                @endphp
                <span class="{{ $fuelColor }}">{{ ucfirst($vehicle->fuel_type) }}</span>
            </div>
            <div style="color:var(--eco-muted); font-size:.78rem; margin-top:.8rem;">
                <i class="bi bi-map me-1"></i> {{ $vehicle->trips()->count() }} trips logged
            </div>
        </div>
    </div>
    @endforeach
</div>
@endif
@endsection

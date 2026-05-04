@extends('layouts.app')

@section('title', 'Eco Tips')

@section('content')
<div class="page-header">
    <h1>Eco Driving Tips</h1>
    <p>Practical advice to reduce your emissions and improve your eco score.</p>
</div>

@php
$categoryMeta = [
    'driving'     => ['label'=>'Driving Habits',   'icon'=>'bi-steering',          'color'=>'#22c55e'],
    'maintenance' => ['label'=>'Vehicle Maintenance','icon'=>'bi-tools',             'color'=>'#60a5fa'],
    'fuel'        => ['label'=>'Fuel & Energy',     'icon'=>'bi-fuel-pump-fill',    'color'=>'#fbbf24'],
];
@endphp

@foreach($tips as $category => $categoryTips)
@php $meta = $categoryMeta[$category] ?? ['label'=>ucfirst($category), 'icon'=>'bi-lightbulb', 'color'=>'#94a3b8']; @endphp
<div class="mb-4">
    <div class="d-flex align-items-center gap-2 mb-3">
        <div style="background:rgba(255,255,255,.06); border-radius:10px; padding:.5rem .7rem; font-size:1.2rem; color:{{ $meta['color'] }};">
            <i class="bi {{ $meta['icon'] }}"></i>
        </div>
        <h5 style="font-weight:700; margin:0;">{{ $meta['label'] }}</h5>
        <span class="badge-blue">{{ $categoryTips->count() }} tips</span>
    </div>

    <div class="row g-3">
        @foreach($categoryTips as $tip)
        <div class="col-md-6">
            <div class="eco-card tip-card h-100">
                <div class="d-flex gap-3">
                    <div style="font-size:2rem; min-width:40px; color:{{ $meta['color'] }};">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                    <div>
                        <h6 style="font-weight:600; margin-bottom:.4rem;">{{ $tip->title }}</h6>
                        <p style="color:var(--eco-muted); font-size:.85rem; margin:0;">{{ $tip->description }}</p>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endforeach

@if($tips->isEmpty())
<div class="eco-card text-center py-5">
    <i class="bi bi-lightbulb" style="font-size:3.5rem; color:var(--eco-muted);"></i>
    <h5 class="mt-3" style="color:var(--eco-muted);">No tips available yet</h5>
    <p style="color:var(--eco-muted); font-size:.9rem;">Check back soon for eco driving tips!</p>
</div>
@endif
@endsection

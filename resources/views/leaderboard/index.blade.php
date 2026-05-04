@extends('layouts.app')

@section('title', 'Leaderboard')

@section('content')
<div class="page-header">
    <h1>🏆 Leaderboard</h1>
    <p>Top 10 eco-conscious drivers ranked by total eco score.</p>
</div>

@if($entries->isEmpty())
<div class="eco-card text-center py-5">
    <i class="bi bi-trophy" style="font-size:3.5rem; color:var(--eco-muted);"></i>
    <h5 class="mt-3" style="color:var(--eco-muted);">No data yet — be the first on the board!</h5>
    <a href="{{ route('trips.create') }}" class="btn-eco btn mt-2">Log a Trip</a>
</div>
@else

<!-- Top 3 Podium -->
@php $top3 = $entries->take(3); @endphp
<div class="row g-3 mb-4 justify-content-center">
    @foreach($top3 as $i => $entry)
    @php
    $gradient = match($i) {
        0 => 'linear-gradient(135deg, rgba(251,191,36,.15), rgba(245,158,11,.05))',
        1 => 'linear-gradient(135deg, rgba(156,163,175,.12), rgba(107,114,128,.05))',
        2 => 'linear-gradient(135deg, rgba(180,83,9,.12), rgba(146,64,14,.05))',
        default => '',
    };
    $borderColor = match($i) {
        0 => 'rgba(251,191,36,.3)',
        1 => 'rgba(156,163,175,.2)',
        2 => 'rgba(180,83,9,.25)',
        default => 'rgba(255,255,255,.06)',
    };
    $order = match($i) { 0 => 'order-md-2', 1 => 'order-md-1', 2 => 'order-md-3', default => '' };
    @endphp
    <div class="col-md-3 {{ $order }}">
        <div class="eco-card text-center h-100" style="background:{{ $gradient }}; border-color:{{ $borderColor }};">
            <div class="rank-badge rank-{{ $i+1 }} mx-auto mb-2">#{{ $i+1 }}</div>
            <div style="width:64px; height:64px; border-radius:50%; background:rgba(255,255,255,.1); display:flex; align-items:center; justify-content:center; font-size:1.6rem; font-weight:700; margin:0 auto .8rem; color:var(--eco-green);">
                {{ strtoupper(substr($entry->user->name, 0, 1)) }}
            </div>
            <div style="font-weight:700; font-size:1rem;">{{ $entry->user->name }}</div>
            <div style="font-size:2rem; font-weight:800; color:var(--eco-green); margin:.3rem 0;">
                {{ number_format($entry->total_eco_score, 0) }}
            </div>
            <div style="font-size:.75rem; color:var(--eco-muted);">Eco Points</div>
            <div class="d-flex justify-content-center gap-2 mt-2">
                <span class="badge-blue" style="font-size:.7rem;">{{ $entry->total_trips }} trips</span>
                <span class="badge-yellow" style="font-size:.7rem;">{{ number_format($entry->total_co2_saved, 1) }} kg CO₂</span>
            </div>
        </div>
    </div>
    @endforeach
</div>

<!-- Full Table -->
<div class="eco-card">
    <table class="eco-table">
        <thead>
            <tr>
                <th>Rank</th>
                <th>Driver</th>
                <th>Eco Score</th>
                <th>Total Trips</th>
                <th>CO₂ Emitted</th>
            </tr>
        </thead>
        <tbody>
            @foreach($entries as $entry)
            <tr @if($entry->user_id === Auth::id()) style="background:rgba(34,197,94,.05);" @endif>
                <td>
                    <span class="rank-badge rank-{{ $entry->rank <= 3 ? $entry->rank : 'other' }}">
                        {{ $entry->rank }}
                    </span>
                </td>
                <td>
                    <div style="font-weight:600;">
                        {{ $entry->user->name }}
                        @if($entry->user_id === Auth::id())
                        <span class="badge-green ms-1" style="font-size:.68rem;">You</span>
                        @endif
                    </div>
                </td>
                <td><span style="color:var(--eco-green); font-weight:700;">{{ number_format($entry->total_eco_score, 2) }}</span></td>
                <td>{{ $entry->total_trips }}</td>
                <td>{{ number_format($entry->total_co2_saved, 2) }} kg</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif
@endsection

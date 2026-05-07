<x-app-layout>
@section('title', 'My Trips')

<div class="space-y-6 page-enter">

    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <div class="text-xs font-bold uppercase tracking-widest mb-2" style="color:#00FF87;">Your History</div>
            <h1 class="text-3xl font-black text-white">My Trips</h1>
            <p class="text-slate-400 mt-1">Every journey logged is a step toward a greener future.</p>
        </div>
        <a href="{{ route('trips.create') }}" class="btn-primary">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Log New Trip
        </a>
    </div>

    @if($trips->count())
    <!-- Summary bar -->
    <div class="grid grid-cols-3 gap-4">
        <div class="glass-card p-4 text-center">
            <div class="text-2xl font-black text-white">{{ $trips->total() }}</div>
            <div class="text-xs text-slate-500 mt-1">Total Trips</div>
        </div>
        <div class="glass-card p-4 text-center">
            <div class="text-2xl font-black" style="color:#4ECDC4;">
                {{ number_format($trips->sum('co2_emitted_kg'), 1) }} kg
            </div>
            <div class="text-xs text-slate-500 mt-1">CO₂ This Page</div>
        </div>
        <div class="glass-card p-4 text-center">
            <div class="text-2xl font-black" style="color:#45B7D1;">
                {{ number_format($trips->sum('distance_km'), 1) }} km
            </div>
            <div class="text-xs text-slate-500 mt-1">Distance This Page</div>
        </div>
    </div>

    <!-- Trips Table -->
    <div class="glass-card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr style="border-bottom: 1px solid rgba(255,255,255,0.06);">
                        <th class="text-left px-6 py-4 text-xs font-bold uppercase tracking-widest text-slate-500">Date</th>
                        <th class="text-left px-6 py-4 text-xs font-bold uppercase tracking-widest text-slate-500">Type</th>
                        <th class="text-left px-6 py-4 text-xs font-bold uppercase tracking-widest text-slate-500">Fuel</th>
                        <th class="text-right px-6 py-4 text-xs font-bold uppercase tracking-widest text-slate-500">Distance</th>
                        <th class="text-right px-6 py-4 text-xs font-bold uppercase tracking-widest text-slate-500">CO₂ Emitted</th>
                        <th class="text-center px-6 py-4 text-xs font-bold uppercase tracking-widest text-slate-500">Impact</th>
                        <th class="px-6 py-4"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($trips as $trip)
                    <tr class="border-b border-white/[0.04] hover:bg-white/[0.02] transition-colors group">
                        <td class="px-6 py-4 text-sm text-slate-300 font-medium">
                            {{ $trip->date->format('d M Y') }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <span class="text-lg">
                                    {{ $trip->fuel_type === 'electric' ? '⚡' : ($trip->fuel_type === 'hybrid' ? '🔋' : '🚗') }}
                                </span>
                                <span class="text-sm text-slate-300">{{ $trip->vehicle_type ?? 'N/A' }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-sm text-slate-400 capitalize">{{ $trip->fuel_type ?? '—' }}</span>
                        </td>
                        <td class="px-6 py-4 text-right text-sm font-semibold text-white">
                            {{ $trip->distance_km }} km
                        </td>
                        <td class="px-6 py-4 text-right text-sm font-semibold text-white">
                            {{ $trip->co2_emitted_kg }} kg
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if($trip->emission_badge === 'green')
                                <span class="emission-green">🟢 Low</span>
                            @elseif($trip->emission_badge === 'yellow')
                                <span class="emission-yellow">🟡 Medium</span>
                            @else
                                <span class="emission-red">🔴 High</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <form method="POST" action="{{ route('trips.destroy', $trip) }}"
                                  onsubmit="return confirm('Delete this trip?')">
                                @csrf @method('DELETE')
                                <button type="submit"
                                        class="opacity-0 group-hover:opacity-100 text-slate-600 hover:text-red-400 transition-all duration-200">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="flex justify-center">
        {{ $trips->links() }}
    </div>

    @else
    <!-- Empty State -->
    <div class="glass-card p-20 text-center">
        <div class="text-6xl mb-6">🛣️</div>
        <h2 class="text-2xl font-bold text-white mb-3">No trips logged yet</h2>
        <p class="text-slate-400 max-w-md mx-auto mb-8">
            Start tracking your drives to understand your carbon footprint and compete on the leaderboard.
        </p>
        <a href="{{ route('trips.create') }}" class="btn-primary text-base px-8 py-4">
            Log Your First Trip
        </a>
    </div>
    @endif
</div>
</x-app-layout>

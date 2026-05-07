<x-app-layout>
@section('title', 'My Vehicles')

<div class="space-y-6 page-enter">

    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <div class="text-xs font-bold uppercase tracking-widest mb-2" style="color:#00FF87;">Garage</div>
            <h1 class="text-3xl font-black text-white">My Vehicles</h1>
            <p class="text-slate-400 mt-1">Track emissions per vehicle and compare performance.</p>
        </div>
        <a href="{{ route('vehicles.create') }}" class="btn-primary">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Add Vehicle
        </a>
    </div>

    @if($vehicles->count())

    <!-- Vehicle Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        @foreach($vehicles as $vehicle)
        <div class="glass-card p-6 relative overflow-hidden group transition-all duration-300
                    hover:border-white/20"
             style="{{ $vehicle->is_primary ? 'border-color: rgba(0,255,135,0.3);' : '' }}">

            @if($vehicle->is_primary)
            <div class="absolute top-4 right-4 text-xs font-bold px-2.5 py-1 rounded-full"
                 style="background: rgba(0,255,135,0.15); color:#00FF87;">
                ★ Primary
            </div>
            @endif

            <!-- Vehicle Header -->
            <div class="flex items-start gap-4 mb-5">
                <div class="w-14 h-14 rounded-2xl flex items-center justify-center text-3xl flex-shrink-0"
                     style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.06);">
                    {{ $vehicle->fuel_type === 'electric' ? '⚡' : ($vehicle->fuel_type === 'hybrid' ? '🔋' : ($vehicle->fuel_type === 'cng' ? '💨' : '🚗')) }}
                </div>
                <div>
                    <h2 class="text-lg font-black text-white">{{ $vehicle->display_name }}</h2>
                    <p class="text-slate-400 text-sm capitalize">{{ $vehicle->fuel_type }} · {{ $vehicle->engine_cc ? $vehicle->engine_cc . 'cc' : 'N/A' }}</p>
                </div>
            </div>

            <!-- Stats Row -->
            <div class="grid grid-cols-3 gap-3 mb-5">
                <!-- CO2/km -->
                <div class="rounded-xl p-3 text-center" style="background: rgba(255,255,255,0.03);">
                    <div class="text-lg font-black text-white">{{ $vehicle->co2_per_km }}</div>
                    <div class="text-xs text-slate-500 mt-0.5">g CO₂/km</div>
                </div>

                <!-- Year -->
                <div class="rounded-xl p-3 text-center" style="background: rgba(255,255,255,0.03);">
                    <div class="text-lg font-black text-white">{{ $vehicle->year }}</div>
                    <div class="text-xs text-slate-500 mt-0.5">Year</div>
                </div>

                <!-- Rating Badge (EU Style) -->
                <div class="rounded-xl p-3 text-center" style="background: rgba(255,255,255,0.03);">
                    <div class="text-lg font-black" style="color: {{ $vehicle->rating_color }};">
                        {{ $vehicle->emission_rating }}
                    </div>
                    <div class="text-xs text-slate-500 mt-0.5">EU Rating</div>
                </div>
            </div>

            <!-- EU Energy Label Bar -->
            <div class="mb-5">
                <div class="flex items-center justify-between text-xs text-slate-500 mb-2">
                    <span>Emission Rating</span>
                    <span style="color: {{ $vehicle->rating_color }}; font-weight: 700;">{{ $vehicle->emission_rating }}</span>
                </div>
                <div class="flex gap-1">
                    @foreach(['A++','A+','A','B','C','D','E','F'] as $rating)
                    @php
                        $colors = ['A++'=>'#00C853','A+'=>'#4CAF50','A'=>'#8BC34A','B'=>'#CDDC39','C'=>'#FFC107','D'=>'#FF9800','E'=>'#FF5722','F'=>'#F44336'];
                        $isActive = $rating === $vehicle->emission_rating;
                    @endphp
                    <div class="flex-1 h-2 rounded-sm transition-all"
                         style="background: {{ $isActive ? $colors[$rating] : 'rgba(255,255,255,0.06)' }};
                                {{ $isActive ? 'box-shadow: 0 0 8px ' . $colors[$rating] . ';' : '' }}">
                    </div>
                    @endforeach
                </div>
                <div class="flex justify-between text-xs text-slate-700 mt-1">
                    <span>A++ (Best)</span>
                    <span>F (Worst)</span>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-between pt-4 border-t border-white/5">
                <span class="text-xs text-slate-600">
                    {{ $vehicle->trips()->count() }} trips logged
                </span>
                <form method="POST" action="{{ route('vehicles.destroy', $vehicle) }}"
                      onsubmit="return confirm('Remove {{ $vehicle->display_name }}?')">
                    @csrf @method('DELETE')
                    <button type="submit"
                            class="text-slate-600 hover:text-red-400 text-xs font-medium transition-colors flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        Remove
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>

    @else
    <!-- Empty State -->
    <div class="glass-card p-20 text-center">
        <div class="text-6xl mb-6">🚗</div>
        <h2 class="text-2xl font-bold text-white mb-3">No vehicles added yet</h2>
        <p class="text-slate-400 max-w-md mx-auto mb-8">
            Add your vehicles to get accurate CO₂ calculations per trip and compare emission ratings.
        </p>
        <a href="{{ route('vehicles.create') }}" class="btn-primary text-base px-8 py-4">
            Add Your First Vehicle
        </a>
    </div>
    @endif

</div>
</x-app-layout>

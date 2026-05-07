<x-app-layout>
@section('title', 'Add Vehicle')

<div class="max-w-2xl mx-auto page-enter">

    <!-- Header -->
    <div class="mb-8">
        <div class="text-xs font-bold uppercase tracking-widest mb-2" style="color:#00FF87;">Garage</div>
        <h1 class="text-3xl font-black text-white">Add a Vehicle</h1>
        <p class="text-slate-400 mt-2">Link vehicles to your trips for precise CO₂ tracking.</p>
    </div>

    <form method="POST" action="{{ route('vehicles.store') }}" class="glass-card p-8 space-y-6">
        @csrf

        <!-- Make + Model -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-semibold text-slate-300 mb-2">
                    Make <span class="text-red-400">*</span>
                </label>
                <input type="text" name="make" value="{{ old('make') }}"
                       placeholder="e.g. Toyota, Tata, Honda"
                       class="eco-input @error('make') !border-red-500 @enderror">
                @error('make')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-300 mb-2">
                    Model <span class="text-red-400">*</span>
                </label>
                <input type="text" name="model" value="{{ old('model') }}"
                       placeholder="e.g. Prius, Nexon, City"
                       class="eco-input @error('model') !border-red-500 @enderror">
                @error('model')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
        </div>

        <!-- Year + Engine CC -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-semibold text-slate-300 mb-2">
                    Year <span class="text-red-400">*</span>
                </label>
                <input type="number" name="year" value="{{ old('year', date('Y')) }}"
                       min="1990" max="{{ date('Y') + 1 }}"
                       class="eco-input @error('year') !border-red-500 @enderror">
                @error('year')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-300 mb-2">Engine CC (Optional)</label>
                <div class="relative">
                    <input type="number" name="engine_cc" value="{{ old('engine_cc') }}"
                           placeholder="e.g. 1498"
                           min="0" step="1"
                           class="eco-input pr-10">
                    <span class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-500 text-xs">cc</span>
                </div>
            </div>
        </div>

        <!-- Fuel Type -->
        <div>
            <label class="block text-sm font-semibold text-slate-300 mb-3">
                Fuel Type <span class="text-red-400">*</span>
            </label>
            <div class="grid grid-cols-2 sm:grid-cols-5 gap-3">
                @foreach([
                    ['petrol',   '⛽', 'Petrol'],
                    ['diesel',   '🛢️', 'Diesel'],
                    ['hybrid',   '🔋', 'Hybrid'],
                    ['electric', '⚡', 'Electric'],
                    ['cng',      '💨', 'CNG'],
                ] as [$val, $icon, $label])
                <label class="cursor-pointer">
                    <input type="radio" name="fuel_type" value="{{ $val }}"
                           class="sr-only peer"
                           {{ old('fuel_type') === $val ? 'checked' : ($val === 'petrol' && !old('fuel_type') ? 'checked' : '') }}>
                    <div class="rounded-xl p-3 text-center border transition-all duration-200 peer-checked:border-[#00FF87] peer-checked:bg-[rgba(0,255,135,0.1)]"
                         style="background: rgba(255,255,255,0.03); border-color: rgba(255,255,255,0.08);">
                        <div class="text-2xl mb-1">{{ $icon }}</div>
                        <div class="text-xs font-bold text-white">{{ $label }}</div>
                    </div>
                </label>
                @endforeach
            </div>
            @error('fuel_type')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        <!-- CO2/km + Emission Rating -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-semibold text-slate-300 mb-2">
                    CO₂ Emissions <span class="text-red-400">*</span>
                </label>
                <div class="relative">
                    <input type="number" name="co2_per_km" value="{{ old('co2_per_km') }}"
                           placeholder="e.g. 118"
                           min="0" max="999" step="0.1"
                           class="eco-input pr-16 @error('co2_per_km') !border-red-500 @enderror">
                    <span class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-500 text-xs">g/km</span>
                </div>
                <p class="text-xs text-slate-600 mt-1">Found in your vehicle manual or logbook</p>
                @error('co2_per_km')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-300 mb-2">
                    EU Emission Rating <span class="text-red-400">*</span>
                </label>
                <select name="emission_rating" class="eco-input @error('emission_rating') !border-red-500 @enderror">
                    @foreach(['A++','A+','A','B','C','D','E','F'] as $rating)
                    <option value="{{ $rating }}" {{ old('emission_rating') === $rating ? 'selected' : ($rating === 'C' && !old('emission_rating') ? 'selected' : '') }}>
                        {{ $rating }} @switch($rating)
                            @case('A++') — Near zero @break
                            @case('A+')  — Excellent @break
                            @case('A')   — Very good @break
                            @case('B')   — Good @break
                            @case('C')   — Average @break
                            @case('D')   — Below average @break
                            @case('E')   — Poor @break
                            @case('F')   — Very poor @break
                        @endswitch
                    </option>
                    @endforeach
                </select>
                @error('emission_rating')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
        </div>

        <!-- Primary vehicle -->
        <div class="flex items-center gap-3 p-4 rounded-xl" style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.06);">
            <input type="checkbox" name="is_primary" id="is_primary" value="1"
                   {{ old('is_primary') ? 'checked' : '' }}
                   class="w-4 h-4 rounded" style="accent-color: #00FF87;">
            <label for="is_primary" class="text-sm font-medium text-slate-300 cursor-pointer">
                Set as my primary vehicle
                <span class="text-slate-500 font-normal">— used by default when logging trips</span>
            </label>
        </div>

        <!-- Actions -->
        <div class="flex items-center justify-between pt-2">
            <a href="{{ route('vehicles.index') }}" class="text-slate-500 hover:text-white text-sm font-medium transition-colors">
                ← Back to garage
            </a>
            <button type="submit" class="btn-primary px-8 py-3">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                Add Vehicle
            </button>
        </div>
    </form>
</div>
</x-app-layout>

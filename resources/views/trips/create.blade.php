<x-app-layout>
@section('title', 'Log a Trip')

<div class="max-w-2xl mx-auto page-enter">

    <!-- Header -->
    <div class="mb-8">
        <div class="text-xs font-bold uppercase tracking-widest mb-2" style="color:#00FF87;">Carbon Tracker</div>
        <h1 class="text-3xl font-black text-white">Log a New Trip</h1>
        <p class="text-slate-400 mt-2">Record your journey and see your CO₂ impact instantly.</p>
    </div>

    <!-- Live CO2 Preview Banner -->
    <div id="co2-preview"
         class="mb-6 rounded-2xl p-5 flex items-center gap-4 transition-all duration-500"
         style="background: rgba(0,255,135,0.06); border: 1px solid rgba(0,255,135,0.15); opacity:0.4;">
        <div class="text-3xl">🌿</div>
        <div>
            <p class="text-xs text-slate-500 uppercase tracking-wider font-bold">Estimated Emission</p>
            <p class="text-3xl font-black text-white mt-1">
                <span id="preview-co2">0.00</span>
                <span class="text-lg font-semibold text-slate-400">kg CO₂</span>
            </p>
            <p class="text-xs text-slate-500 mt-1" id="preview-coal">
                = burning <span class="font-bold text-slate-300">0.00 kg</span> of coal
            </p>
        </div>
        <div class="ml-auto">
            <div id="preview-badge" class="px-3 py-1.5 rounded-full text-xs font-bold" style="background:rgba(0,255,135,0.15); color:#00FF87;">
                🟢 Low Impact
            </div>
        </div>
    </div>

    <!-- Form -->
    <form method="POST" action="{{ route('trips.store') }}" class="glass-card p-8 space-y-6" id="trip-form">
        @csrf

        <!-- Date + Distance -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-semibold text-slate-300 mb-2">
                    Trip Date <span class="text-red-400">*</span>
                </label>
                <input type="date" name="date" id="trip-date"
                       value="{{ old('date', date('Y-m-d')) }}"
                       max="{{ date('Y-m-d') }}"
                       class="eco-input @error('date') !border-red-500 @enderror">
                @error('date')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-300 mb-2">
                    Distance <span class="text-red-400">*</span>
                </label>
                <div class="relative">
                    <input type="number" name="distance_km" id="distance-input"
                           value="{{ old('distance_km') }}"
                           placeholder="e.g. 25.5"
                           min="0.1" max="5000" step="0.1"
                           class="eco-input pr-12 @error('distance_km') !border-red-500 @enderror"
                           oninput="updateCO2Preview()">
                    <span class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-500 text-sm font-medium">km</span>
                </div>
                @error('distance_km')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
        </div>

        <!-- Fuel Type -->
        <div>
            <label class="block text-sm font-semibold text-slate-300 mb-3">
                Fuel Type <span class="text-red-400">*</span>
            </label>
            <div class="grid grid-cols-2 sm:grid-cols-5 gap-3" id="fuel-selector">
                @foreach([
                    ['petrol',   '⛽', 'Petrol',   '0.21 kg/km'],
                    ['diesel',   '🛢️', 'Diesel',   '0.27 kg/km'],
                    ['hybrid',   '🔋', 'Hybrid',   '0.10 kg/km'],
                    ['electric', '⚡', 'Electric', '0.05 kg/km'],
                    ['cng',      '💨', 'CNG',      '0.18 kg/km'],
                ] as [$val, $icon, $label, $rate])
                <label class="fuel-option cursor-pointer">
                    <input type="radio" name="fuel_type" value="{{ $val }}"
                           class="sr-only" {{ old('fuel_type') === $val ? 'checked' : ($val === 'petrol' && !old('fuel_type') ? 'checked' : '') }}
                           onchange="updateCO2Preview()">
                    <div class="fuel-card rounded-xl p-3 text-center border transition-all duration-200"
                         style="background: rgba(255,255,255,0.03); border-color: rgba(255,255,255,0.08);"
                         data-value="{{ $val }}">
                        <div class="text-2xl mb-1">{{ $icon }}</div>
                        <div class="text-xs font-bold text-white">{{ $label }}</div>
                        <div class="text-xs text-slate-600 mt-0.5">{{ $rate }}</div>
                    </div>
                </label>
                @endforeach
            </div>
            @error('fuel_type')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        <!-- Vehicle Type + Vehicle -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-semibold text-slate-300 mb-2">
                    Vehicle Type <span class="text-red-400">*</span>
                </label>
                <select name="vehicle_type" class="eco-input @error('vehicle_type') !border-red-500 @enderror">
                    <option value="">Select type...</option>
                    @foreach(['Sedan', 'Hatchback', 'SUV', 'Van', 'Truck', 'Two-wheeler', 'Bus', 'Other'] as $type)
                        <option value="{{ $type }}" {{ old('vehicle_type') === $type ? 'selected' : '' }}>{{ $type }}</option>
                    @endforeach
                </select>
                @error('vehicle_type')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-300 mb-2">My Vehicle (Optional)</label>
                <select name="vehicle_id" class="eco-input">
                    <option value="">Not linked to a vehicle</option>
                    @foreach($vehicles as $vehicle)
                        <option value="{{ $vehicle->id }}" {{ old('vehicle_id') == $vehicle->id ? 'selected' : '' }}>
                            {{ $vehicle->display_name }}
                        </option>
                    @endforeach
                </select>
                @if($vehicles->isEmpty())
                    <p class="text-xs text-slate-600 mt-1">
                        <a href="{{ route('vehicles.create') }}" style="color:#00FF87;" class="hover:underline">Add a vehicle</a> to link trips.
                    </p>
                @endif
            </div>
        </div>

        <!-- Notes -->
        <div>
            <label class="block text-sm font-semibold text-slate-300 mb-2">Notes (Optional)</label>
            <textarea name="notes" rows="2" placeholder="e.g. Office commute via highway..."
                      class="eco-input resize-none">{{ old('notes') }}</textarea>
        </div>

        <!-- Submit -->
        <div class="flex items-center justify-between pt-2">
            <a href="{{ route('trips.index') }}" class="text-slate-500 hover:text-white text-sm font-medium transition-colors">
                ← Back to trips
            </a>
            <button type="submit" class="btn-primary px-8 py-3">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                Log This Trip
            </button>
        </div>
    </form>

    <!-- Tips -->
    <div class="mt-4 text-center text-xs text-slate-600">
        💡 Tip: Accurate fuel type selection ensures precise CO₂ calculations.
    </div>
</div>

<script>
const emissionFactors = { petrol: 0.21, diesel: 0.27, electric: 0.05, hybrid: 0.10, cng: 0.18 };

function updateCO2Preview() {
    const distance = parseFloat(document.getElementById('distance-input').value) || 0;
    const selectedFuel = document.querySelector('input[name="fuel_type"]:checked');
    const fuelType = selectedFuel ? selectedFuel.value : 'petrol';
    const factor = emissionFactors[fuelType] || 0.21;
    const co2 = (distance * factor).toFixed(2);
    const coal = (co2 / 2.42).toFixed(2);

    document.getElementById('preview-co2').textContent = co2;
    document.getElementById('preview-coal').innerHTML =
        `= burning <span class="font-bold text-slate-300">${coal} kg</span> of coal`;

    const preview = document.getElementById('co2-preview');
    const badge = document.getElementById('preview-badge');

    preview.style.opacity = distance > 0 ? '1' : '0.4';

    if (co2 < 2) {
        badge.textContent = '🟢 Low Impact';
        badge.style.background = 'rgba(0,255,135,0.15)';
        badge.style.color = '#00FF87';
    } else if (co2 < 5) {
        badge.textContent = '🟡 Medium Impact';
        badge.style.background = 'rgba(255,193,7,0.15)';
        badge.style.color = '#FFC107';
    } else {
        badge.textContent = '🔴 High Impact';
        badge.style.background = 'rgba(244,67,54,0.15)';
        badge.style.color = '#FF5722';
    }

    // Style selected fuel card
    document.querySelectorAll('.fuel-card').forEach(card => {
        const isSelected = card.dataset.value === fuelType;
        card.style.borderColor = isSelected ? '#00FF87' : 'rgba(255,255,255,0.08)';
        card.style.background = isSelected ? 'rgba(0,255,135,0.1)' : 'rgba(255,255,255,0.03)';
        card.style.boxShadow = isSelected ? '0 0 15px rgba(0,255,135,0.15)' : 'none';
    });
}

// Run on load to set default state
document.addEventListener('DOMContentLoaded', updateCO2Preview);
</script>
</x-app-layout>

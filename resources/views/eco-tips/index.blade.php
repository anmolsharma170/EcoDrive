<x-app-layout>
@section('title', 'Eco Tips')

<div class="space-y-8 page-enter" x-data="{ activeCategory: '{{ $category }}' }">

    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4">
        <div>
            <div class="text-xs font-bold uppercase tracking-widest mb-2" style="color:#00FF87;">Knowledge Hub</div>
            <h1 class="text-3xl font-black text-white">Eco Driving Tips</h1>
            <p class="text-slate-400 mt-1">Science-backed tips to slash your CO₂ — and your fuel bill.</p>
        </div>
        <div class="text-sm text-slate-500">
            {{ $tips->count() }} tips
            @if($category !== 'all') in <strong class="text-slate-300 capitalize">{{ $category }}</strong> @endif
        </div>
    </div>

    <!-- Tip of the Day -->
    @if($tipOfDay)
    <div class="rounded-2xl p-6 relative overflow-hidden"
         style="background: linear-gradient(135deg, rgba(0,255,135,0.08) 0%, rgba(69,183,209,0.05) 100%); border: 1px solid rgba(0,255,135,0.2);">
        <div class="absolute top-4 right-4 text-xs font-bold uppercase tracking-widest px-3 py-1 rounded-full"
             style="background: rgba(0,255,135,0.15); color:#00FF87;">
            ✨ Tip of the Day
        </div>
        <div class="flex items-start gap-5">
            <div class="text-5xl flex-shrink-0">{{ $tipOfDay->icon ?? '💡' }}</div>
            <div>
                <h2 class="text-xl font-black text-white mb-2">{{ $tipOfDay->title }}</h2>
                <p class="text-slate-300 leading-relaxed">{{ $tipOfDay->description }}</p>
                <div class="mt-4 flex items-center gap-3 flex-wrap">
                    <span class="text-sm font-bold px-3 py-1.5 rounded-full"
                          style="background: rgba(0,255,135,0.12); color:#00FF87;">
                        🌿 Saves ~{{ $tipOfDay->estimated_co2_savings_kg }}kg CO₂/year
                    </span>
                    <span class="text-xs text-slate-500 capitalize">Category: {{ $tipOfDay->category }}</span>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Category Filter -->
    <div class="flex flex-wrap gap-2">
        <a href="{{ route('eco-tips.index') }}"
           class="px-4 py-2 rounded-xl text-sm font-semibold transition-all duration-200
                  {{ $category === 'all' ? 'text-[#0A0F1E]' : 'text-slate-400 hover:text-white' }}"
           style="{{ $category === 'all' ? 'background: #00FF87;' : 'background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.08);' }}">
            All Tips
        </a>
        @foreach($categories as $cat)
        <a href="{{ route('eco-tips.index', ['category' => $cat]) }}"
           class="px-4 py-2 rounded-xl text-sm font-semibold transition-all duration-200 capitalize
                  {{ $category === $cat ? 'text-[#0A0F1E]' : 'text-slate-400 hover:text-white' }}"
           style="{{ $category === $cat ? 'background: #00FF87;' : 'background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.08);' }}">
            @switch($cat)
                @case('driving')    🚗 @break
                @case('maintenance') 🔧 @break
                @case('planning')   🗺️ @break
                @case('vehicle')    ⚡ @break
                @default 💡
            @endswitch
            {{ ucfirst($cat) }}
        </a>
        @endforeach
    </div>

    <!-- Tips Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
        @forelse($tips as $tip)
        <div class="glass-card-hover p-6 flex flex-col gap-4">
            <!-- Icon + Category -->
            <div class="flex items-center justify-between">
                <span class="text-3xl">{{ $tip->icon ?? '💡' }}</span>
                <span class="text-xs font-bold uppercase tracking-wider px-2.5 py-1 rounded-full capitalize"
                      style="background: rgba(255,255,255,0.05); color: #64748b;">
                    {{ $tip->category }}
                </span>
            </div>

            <!-- Title & Description -->
            <div>
                <h3 class="text-base font-bold text-white mb-2">{{ $tip->title }}</h3>
                <p class="text-slate-400 text-sm leading-relaxed">{{ $tip->description }}</p>
            </div>

            <!-- Savings -->
            <div class="mt-auto pt-4 border-t border-white/5 flex items-center justify-between">
                <div>
                    <div class="text-xs text-slate-600">Estimated annual saving</div>
                    <div class="text-lg font-black" style="color:#00FF87;">
                        {{ $tip->estimated_co2_savings_kg }} kg CO₂
                    </div>
                </div>
                <div class="text-xs px-3 py-1.5 rounded-lg font-semibold"
                     style="background: rgba(0,255,135,0.1); color:#00FF87;">
                    🌿 Act Now
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-3 glass-card p-16 text-center">
            <div class="text-5xl mb-4">🔍</div>
            <p class="text-slate-400">No tips in this category yet.</p>
            <a href="{{ route('eco-tips.index') }}" class="btn-ghost mt-4 inline-flex">View All Tips</a>
        </div>
        @endforelse
    </div>

</div>
</x-app-layout>

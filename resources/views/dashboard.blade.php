<x-app-layout>
@section('title', 'Dashboard')

<div class="space-y-6 page-enter">

    <!-- ── Welcome Header ──────────────────────────────────── -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-black text-white">
                Good {{ now()->hour < 12 ? 'morning' : (now()->hour < 17 ? 'afternoon' : 'evening') }},
                <span style="color:#00FF87;">{{ explode(' ', auth()->user()->name)[0] }}</span> 👋
            </h1>
            <p class="text-slate-400 text-sm mt-1">Here's your eco impact at a glance.</p>
        </div>
        <div class="flex items-center gap-3">
            <!-- Streak badge -->
            <div class="flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-semibold"
                 style="background: rgba(255,107,107,0.1); border: 1px solid rgba(255,107,107,0.2); color:#FF6B6B;">
                🔥 {{ $currentStreak }} day streak
            </div>
            <!-- Eco Grade -->
            <div class="px-4 py-2 rounded-xl text-sm font-black"
                 style="background: rgba(0,255,135,0.1); border: 1px solid rgba(0,255,135,0.25); color:#00FF87;">
                Grade {{ auth()->user()->eco_grade }}
            </div>
        </div>
    </div>

    <!-- ── 4 Stat Cards ─────────────────────────────────────── -->
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">

        <!-- Eco Score -->
        <div class="stat-card group cursor-default" style="background: rgba(0,255,135,0.05); border-color: rgba(0,255,135,0.15);">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold uppercase tracking-widest text-slate-500">Eco Score</span>
                <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background:rgba(0,255,135,0.15);">
                    <svg class="w-4 h-4" style="color:#00FF87;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
            </div>
            <div class="text-4xl font-black text-white" id="eco-score-count" data-target="{{ auth()->user()->eco_score }}">
                {{ auth()->user()->eco_score }}
            </div>
            <div class="text-xs text-slate-500">out of 1000 pts</div>
        </div>

        <!-- CO2 Saved -->
        <div class="stat-card" style="background: rgba(78,205,196,0.05); border-color: rgba(78,205,196,0.15);">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold uppercase tracking-widest text-slate-500">CO₂ Saved</span>
                <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background:rgba(78,205,196,0.15);">
                    <svg class="w-4 h-4" style="color:#4ECDC4;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="text-4xl font-black text-white">{{ number_format(auth()->user()->co2_saved_this_month, 1) }}</span>
                <span class="text-sm font-semibold" style="color:#4ECDC4;">kg</span>
            </div>
            <div class="text-xs text-slate-500">this month</div>
        </div>

        <!-- Rank -->
        <div class="stat-card" style="background: rgba(69,183,209,0.05); border-color: rgba(69,183,209,0.15);">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold uppercase tracking-widest text-slate-500">Your Rank</span>
                <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background:rgba(69,183,209,0.15);">
                    <svg class="w-4 h-4" style="color:#45B7D1;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                </div>
            </div>
            <div class="flex items-baseline gap-1">
                <span class="text-4xl font-black text-white">#{{ $rank }}</span>
                <span class="text-sm text-slate-500">/ {{ $totalUsers }}</span>
            </div>
            @if($pointsToNextRank > 0)
            <div class="text-xs" style="color:#45B7D1;">{{ $pointsToNextRank }} pts to next rank</div>
            @else
            <div class="text-xs" style="color:#00FF87;">🏆 You're #1!</div>
            @endif
        </div>

        <!-- Trips Logged -->
        <div class="stat-card" style="background: rgba(255,193,7,0.05); border-color: rgba(255,193,7,0.15);">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold uppercase tracking-widest text-slate-500">Trips Logged</span>
                <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background:rgba(255,193,7,0.15);">
                    <svg class="w-4 h-4" style="color:#FFC107;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/></svg>
                </div>
            </div>
            <div class="text-4xl font-black text-white">{{ auth()->user()->trips_logged }}</div>
            <div class="text-xs text-slate-500">all time</div>
        </div>
    </div>

    <!-- ── Trees Impact Banner ───────────────────────────────── -->
    <div class="rounded-2xl p-5 flex items-center gap-4"
         style="background: linear-gradient(135deg, rgba(0,255,135,0.08) 0%, rgba(78,205,196,0.05) 100%); border: 1px solid rgba(0,255,135,0.15);">
        <div class="text-4xl">🌳</div>
        <div>
            <p class="text-white font-semibold">
                Your driving saved the equivalent of
                <strong style="color:#00FF87;">{{ $treesEquivalent }} trees</strong> this month.
            </p>
            <p class="text-slate-400 text-sm mt-0.5">
                That's {{ number_format(auth()->user()->co2_saved_this_month, 1) }}kg of CO₂ kept out of the atmosphere. Keep it up!
            </p>
        </div>
        <a href="{{ route('trips.create') }}" class="ml-auto btn-primary text-sm whitespace-nowrap hidden sm:flex">
            Log a Trip →
        </a>
    </div>

    <!-- ── Chart + Achievements ──────────────────────────────── -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Weekly CO2 Chart -->
        <div class="lg:col-span-2 glass-card p-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-lg font-bold text-white">Weekly CO₂ Emissions</h2>
                    <p class="text-slate-500 text-sm">Last 7 days — kg emitted per day</p>
                </div>
                <a href="{{ route('trips.index') }}" class="text-xs font-semibold hover:text-white transition-colors" style="color:#00FF87;">
                    View all trips →
                </a>
            </div>
            <div class="relative h-64">
                <canvas id="co2Chart"></canvas>
            </div>
        </div>

        <!-- Achievements -->
        <div class="glass-card p-6 flex flex-col">
            <div class="flex items-center justify-between mb-5">
                <h2 class="text-lg font-bold text-white">Achievements</h2>
                <span class="text-xs px-2 py-1 rounded-full font-semibold" style="background:rgba(0,255,135,0.1); color:#00FF87;">
                    {{ auth()->user()->achievements()->count() }} earned
                </span>
            </div>
            <div class="space-y-3 flex-1">
                @forelse($userAchievements as $achievement)
                <div class="flex items-center gap-3 p-3 rounded-xl transition-all duration-200 hover:scale-[1.02]"
                     style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.06);">
                    <div class="text-2xl w-10 h-10 flex items-center justify-center rounded-xl flex-shrink-0"
                         style="background: rgba(0,255,135,0.1);">
                        {{ $achievement->icon }}
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-white">{{ $achievement->name }}</p>
                        <p class="text-xs text-slate-500">+{{ $achievement->points }} pts</p>
                    </div>
                    <div class="ml-auto text-xs font-bold" style="color:{{ $achievement->color }};">✓</div>
                </div>
                @empty
                <div class="text-center py-8">
                    <div class="text-4xl mb-3">🎯</div>
                    <p class="text-slate-500 text-sm">Log your first trip to start earning badges!</p>
                    <a href="{{ route('trips.create') }}" class="btn-primary text-sm mt-4 inline-flex">Start Now</a>
                </div>
                @endforelse
            </div>
            @if($userAchievements->count() > 0)
            <a href="{{ route('leaderboard.index') }}" class="mt-4 btn-ghost text-sm text-center justify-center">
                View Leaderboard
            </a>
            @endif
        </div>
    </div>

    <!-- ── Recent Trips + Eco Tips ───────────────────────────── -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Recent Trips -->
        <div class="lg:col-span-2 glass-card p-6">
            <div class="flex items-center justify-between mb-5">
                <h2 class="text-lg font-bold text-white">Recent Trips</h2>
                <a href="{{ route('trips.create') }}" class="btn-primary text-xs px-4 py-2">+ Log Trip</a>
            </div>
            @forelse($recentTrips as $trip)
            <div class="flex items-center gap-4 py-3 border-b border-white/5 last:border-0">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0 text-lg"
                     style="background: rgba(255,255,255,0.04);">
                    {{ $trip->fuel_type === 'electric' ? '⚡' : ($trip->fuel_type === 'hybrid' ? '🔋' : '🚗') }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-white">{{ $trip->vehicle_type ?? 'Trip' }} — {{ $trip->distance_km }} km</p>
                    <p class="text-xs text-slate-500">{{ $trip->date->format('D, d M Y') }} · {{ ucfirst($trip->fuel_type ?? 'Petrol') }}</p>
                </div>
                <div>
                    @if($trip->emission_badge === 'green')
                        <span class="emission-green">{{ $trip->co2_emitted_kg }}kg</span>
                    @elseif($trip->emission_badge === 'yellow')
                        <span class="emission-yellow">{{ $trip->co2_emitted_kg }}kg</span>
                    @else
                        <span class="emission-red">{{ $trip->co2_emitted_kg }}kg</span>
                    @endif
                </div>
            </div>
            @empty
            <div class="text-center py-12">
                <div class="text-5xl mb-4">🛣️</div>
                <p class="text-slate-400 font-medium">No trips logged yet.</p>
                <p class="text-slate-500 text-sm mb-4">Start tracking your carbon footprint today!</p>
                <a href="{{ route('trips.create') }}" class="btn-primary text-sm">Log First Trip</a>
            </div>
            @endforelse
        </div>

        <!-- Eco Tips -->
        <div class="glass-card p-6">
            <div class="flex items-center justify-between mb-5">
                <h2 class="text-lg font-bold text-white">Quick Eco Tips</h2>
                <a href="{{ route('eco-tips.index') }}" class="text-xs font-semibold hover:text-white transition-colors" style="color:#00FF87;">All tips →</a>
            </div>
            <div class="space-y-3">
                @foreach($ecoTips as $tip)
                <div class="p-4 rounded-xl transition-all duration-200 hover:scale-[1.02]"
                     style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.06);">
                    <div class="flex items-start gap-3">
                        <span class="text-xl flex-shrink-0">{{ $tip->icon ?? '💡' }}</span>
                        <div>
                            <p class="text-sm font-semibold text-white">{{ $tip->title }}</p>
                            <p class="text-xs text-slate-500 mt-1 leading-relaxed line-clamp-2">{{ $tip->description }}</p>
                            <div class="mt-2 text-xs font-bold" style="color:#00FF87;">
                                Saves ~{{ $tip->estimated_co2_savings_kg }}kg CO₂/yr
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const ctx = document.getElementById('co2Chart').getContext('2d');

    let grad = ctx.createLinearGradient(0, 0, 0, 260);
    grad.addColorStop(0, 'rgba(0,255,135,0.5)');
    grad.addColorStop(1, 'rgba(0,255,135,0.02)');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($chartDates) !!},
            datasets: [{
                label: 'CO₂ (kg)',
                data: {!! json_encode($chartData) !!},
                backgroundColor: grad,
                borderColor: '#00FF87',
                borderWidth: 2,
                borderRadius: 10,
                borderSkipped: false,
                hoverBackgroundColor: 'rgba(0,255,135,0.7)',
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: 'rgba(8,12,23,0.95)',
                    titleColor: '#00FF87',
                    bodyColor: '#E2E8F0',
                    borderColor: 'rgba(0,255,135,0.3)',
                    borderWidth: 1,
                    padding: 12,
                    cornerRadius: 10,
                    callbacks: {
                        label: ctx => ` ${ctx.parsed.y} kg CO₂`
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: 'rgba(255,255,255,0.04)' },
                    ticks: { color: '#64748b', font: { family: 'Inter', size: 11 }, callback: v => v + 'kg' }
                },
                x: {
                    grid: { display: false },
                    ticks: { color: '#64748b', font: { family: 'Inter', size: 12 } }
                }
            }
        }
    });
});
</script>
</x-app-layout>

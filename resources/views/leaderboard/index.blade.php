<x-app-layout>
@section('title', 'Leaderboard')

<div class="space-y-8 page-enter">

    <!-- Header -->
    <div class="text-center">
        <div class="text-xs font-bold uppercase tracking-widest mb-3" style="color:#00FF87;">Global Rankings</div>
        <h1 class="text-4xl font-black text-white mb-3" style="letter-spacing:-0.02em;">Eco Leaderboard</h1>
        <p class="text-slate-400 max-w-xl mx-auto">Every green trip earns points. Compete globally, drive locally.</p>
    </div>

    <!-- Your Position Banner -->
    <div class="rounded-2xl p-5 flex flex-col sm:flex-row items-center gap-5 text-center sm:text-left"
         style="background: linear-gradient(135deg, rgba(0,255,135,0.08), rgba(69,183,209,0.05)); border: 1px solid rgba(0,255,135,0.2);">
        <div class="w-16 h-16 rounded-2xl flex items-center justify-center text-2xl font-black text-[#0A0F1E] flex-shrink-0"
             style="background: linear-gradient(135deg,#00FF87,#00C9A7);">
            #{{ $userRank }}
        </div>
        <div class="flex-1">
            <p class="font-bold text-white text-lg">You're ranked #{{ $userRank }} out of {{ $totalUsers }} drivers</p>
            @if($pointsToNextRank > 0)
            <p class="text-slate-400 text-sm mt-1">
                Just <strong style="color:#00FF87;">{{ $pointsToNextRank }} more points</strong> to reach rank #{{ $nextRankPosition }}. Log another eco-friendly trip!
            </p>
            @else
            <p class="text-slate-400 text-sm mt-1">🏆 You're the top eco driver! Keep it up!</p>
            @endif
        </div>
        <a href="{{ route('trips.create') }}" class="btn-primary text-sm whitespace-nowrap">
            Earn More Points →
        </a>
    </div>

    <!-- Podium — Top 3 -->
    @if($leaders->count() >= 3)
    <div class="glass-card p-8">
        <h2 class="text-lg font-bold text-white text-center mb-10">🏆 Top 3 Eco Champions</h2>
        <div class="flex items-end justify-center gap-4">

            <!-- 2nd Place -->
            <div class="flex flex-col items-center flex-1 max-w-[200px]">
                <!-- Avatar -->
                <div class="w-16 h-16 rounded-2xl flex items-center justify-center text-xl font-black text-[#0A0F1E] mb-3 ring-4 ring-slate-600"
                     style="background: linear-gradient(135deg, silver, #aaa);">
                    {{ strtoupper(substr($leaders[1]->name, 0, 2)) }}
                </div>
                <p class="text-sm font-bold text-white text-center truncate w-full text-center">{{ explode(' ',$leaders[1]->name)[0] }}</p>
                <p class="text-xs text-slate-500 mb-3">{{ number_format($leaders[1]->eco_score) }} pts</p>
                <!-- Podium bar -->
                <div class="w-full rounded-t-xl flex items-end justify-center pt-4 pb-2"
                     style="height:110px; background: linear-gradient(to top, rgba(192,192,192,0.2), rgba(192,192,192,0.05)); border: 1px solid rgba(192,192,192,0.2); border-bottom: none;">
                    <div class="text-3xl font-black text-slate-400">2</div>
                </div>
            </div>

            <!-- 1st Place (center, elevated) -->
            <div class="flex flex-col items-center flex-1 max-w-[220px] -mb-0">
                <!-- Crown -->
                <div class="text-3xl mb-1 animate-bounce">👑</div>
                <!-- Avatar -->
                <div class="w-20 h-20 rounded-2xl flex items-center justify-center text-2xl font-black text-[#0A0F1E] mb-3 ring-4 ring-[#00FF87]"
                     style="background: linear-gradient(135deg,#00FF87,#00C9A7); box-shadow: 0 0 30px rgba(0,255,135,0.4);">
                    {{ strtoupper(substr($leaders[0]->name, 0, 2)) }}
                </div>
                <p class="text-base font-black text-white text-center truncate w-full text-center">{{ explode(' ',$leaders[0]->name)[0] }}</p>
                <p class="text-sm font-bold mb-3" style="color:#00FF87;">{{ number_format($leaders[0]->eco_score) }} pts</p>
                <!-- Podium bar -->
                <div class="w-full rounded-t-xl flex items-end justify-center pt-4 pb-2"
                     style="height:140px; background: linear-gradient(to top, rgba(0,255,135,0.2), rgba(0,255,135,0.03)); border: 1px solid rgba(0,255,135,0.25); border-bottom: none;">
                    <div class="text-3xl font-black" style="color:#00FF87;">1</div>
                </div>
            </div>

            <!-- 3rd Place -->
            <div class="flex flex-col items-center flex-1 max-w-[200px]">
                <div class="w-16 h-16 rounded-2xl flex items-center justify-center text-xl font-black text-white mb-3 ring-4 ring-amber-700"
                     style="background: linear-gradient(135deg, #CD7F32, #a0522d);">
                    {{ strtoupper(substr($leaders[2]->name, 0, 2)) }}
                </div>
                <p class="text-sm font-bold text-white text-center truncate w-full text-center">{{ explode(' ',$leaders[2]->name)[0] }}</p>
                <p class="text-xs text-slate-500 mb-3">{{ number_format($leaders[2]->eco_score) }} pts</p>
                <div class="w-full rounded-t-xl flex items-end justify-center pt-4 pb-2"
                     style="height:80px; background: linear-gradient(to top, rgba(205,127,50,0.2), rgba(205,127,50,0.03)); border: 1px solid rgba(205,127,50,0.2); border-bottom: none;">
                    <div class="text-3xl font-black text-amber-600">3</div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Full Leaderboard Table -->
    <div class="glass-card overflow-hidden">
        <div class="px-6 py-4 border-b border-white/5 flex items-center justify-between">
            <h2 class="text-lg font-bold text-white">All Rankings</h2>
            <span class="text-xs text-slate-500">{{ $leaders->count() }} drivers ranked</span>
        </div>

        <div class="divide-y divide-white/[0.04]">
            @foreach($leaders as $leader)
            @php
                $isCurrentUser = $leader->id === auth()->id();
                $isTop3 = $leader->rank <= 3;
            @endphp
            <div class="flex items-center gap-4 px-6 py-4 transition-colors hover:bg-white/[0.02]
                        {{ $isCurrentUser ? 'border-l-2' : '' }}"
                 style="{{ $isCurrentUser ? 'border-left-color:#00FF87; background: rgba(0,255,135,0.03);' : '' }}">

                <!-- Rank -->
                <div class="w-10 text-center flex-shrink-0">
                    @if($leader->rank === 1)
                        <span class="text-2xl">🥇</span>
                    @elseif($leader->rank === 2)
                        <span class="text-2xl">🥈</span>
                    @elseif($leader->rank === 3)
                        <span class="text-2xl">🥉</span>
                    @else
                        <span class="text-slate-500 font-bold text-sm">#{{ $leader->rank }}</span>
                    @endif
                </div>

                <!-- Avatar -->
                <div class="w-10 h-10 rounded-xl flex items-center justify-center text-sm font-black text-[#0A0F1E] flex-shrink-0"
                     style="background: {{ $leader->avatar_color }};">
                    {{ strtoupper(substr($leader->name, 0, 2)) }}
                </div>

                <!-- Name -->
                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-2">
                        <p class="text-sm font-semibold text-white truncate">
                            {{ $leader->name }}
                            @if($isCurrentUser)<span class="text-xs ml-1" style="color:#00FF87;">(You)</span>@endif
                        </p>
                    </div>
                    <p class="text-xs text-slate-500">{{ $leader->trips_logged }} trips logged</p>
                </div>

                <!-- CO2 Saved -->
                <div class="text-right hidden sm:block">
                    <div class="text-sm font-semibold" style="color:#4ECDC4;">
                        {{ number_format($leader->co2_saved_this_month, 1) }} kg
                    </div>
                    <div class="text-xs text-slate-500">CO₂ saved</div>
                </div>

                <!-- Score -->
                <div class="text-right flex-shrink-0">
                    <div class="text-lg font-black text-white">{{ number_format($leader->eco_score) }}</div>
                    <div class="text-xs text-slate-500">pts</div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

</div>
</x-app-layout>

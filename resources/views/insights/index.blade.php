<x-app-layout>
@section('title', 'Global Insights')

<div class="space-y-8 page-enter">

    <!-- Header -->
    <div class="text-center">
        <div class="text-xs font-bold uppercase tracking-widest mb-3" style="color:#00FF87;">Real-World Impact</div>
        <h1 class="text-4xl font-black text-white mb-3" style="letter-spacing:-0.02em;">Global Insights</h1>
        <p class="text-slate-400 max-w-xl mx-auto">Understanding the scale of emissions and road safety based on the latest 2024–2025 reports.</p>
    </div>

    <!-- CO2 Emissions Section -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-white mb-4 flex items-center gap-2">
            <span class="text-3xl">🌍</span> Daily CO₂ Emissions
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Global CO2 -->
            <div class="glass-card p-8 text-center relative overflow-hidden" style="border-top: 4px solid #45B7D1;">
                <div class="text-xs font-bold uppercase tracking-widest text-slate-500 mb-2">Global Average (2024/2025)</div>
                <div class="text-5xl font-black mb-2" style="color:#45B7D1;">102.2M</div>
                <div class="text-lg font-semibold text-white mb-4">metric tons / day</div>
                <p class="text-sm text-slate-400 leading-relaxed max-w-sm mx-auto">
                    The world emits over 37.4 billion metric tons of fossil CO₂ annually. That's roughly 102.2 million tons injected into the atmosphere every single day.
                </p>
                <div class="mt-4 text-xs text-slate-600">Source: Global Carbon Budget</div>
            </div>

            <!-- India CO2 -->
            <div class="glass-card p-8 text-center relative overflow-hidden" style="border-top: 4px solid #00FF87;">
                <div class="text-xs font-bold uppercase tracking-widest text-slate-500 mb-2">India Average (2024/2025)</div>
                <div class="text-5xl font-black mb-2" style="color:#00FF87;">8.74M</div>
                <div class="text-lg font-semibold text-white mb-4">metric tons / day</div>
                <p class="text-sm text-slate-400 leading-relaxed max-w-sm mx-auto">
                    India emits approximately 3.19 billion metric tons of fossil CO₂ annually, contributing to about 8.74 million tons daily. Transport is a major factor.
                </p>
                <div class="mt-4 text-xs text-slate-600">Source: Annual Emission Estimates</div>
            </div>
        </div>
    </div>

    <!-- Road Safety Section -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-white mb-4 flex items-center gap-2 mt-12">
            <span class="text-3xl">🛣️</span> Road Safety in India
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Accidents Data -->
            <div class="md:col-span-2 glass-card p-8 relative overflow-hidden" style="border-top: 4px solid #FF6B6B;">
                <div class="flex flex-col lg:flex-row items-center lg:items-start gap-8">
                    <div class="text-center lg:text-left flex-shrink-0">
                        <div class="text-xs font-bold uppercase tracking-widest text-slate-500 mb-2">Daily Fatalities (2024)</div>
                        <div class="text-6xl font-black mb-2" style="color:#FF6B6B;">~485</div>
                        <div class="text-lg font-semibold text-white">lives lost / day</div>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm text-slate-300 leading-relaxed mb-4">
                            According to the latest government data presented to Parliament, India recorded 1,77,177 road crash fatalities in 2024. That equates to roughly 485 deaths every day—a 2.3% increase from the previous year.
                        </p>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
                            <div class="p-3 rounded-xl break-words" style="background: rgba(255,107,107,0.1);">
                                <div class="text-lg font-bold" style="color:#FF6B6B;">31%</div>
                                <div class="text-xs text-slate-400">Occur on National Highways</div>
                            </div>
                            <div class="p-3 rounded-xl break-words" style="background: rgba(255,255,255,0.05);">
                                <div class="text-lg font-bold text-white">#1 Cause</div>
                                <div class="text-xs text-slate-400">Over-speeding</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Safety Regulations -->
            <div class="glass-card p-6 flex flex-col">
                <div class="text-lg font-bold text-white mb-4 flex items-center gap-2">
                    🛡️ Safety Regulations
                </div>
                <div class="space-y-4 flex-1">
                    <div class="flex items-start gap-3">
                        <div class="w-2 h-2 rounded-full mt-1.5" style="background:#00FF87;"></div>
                        <p class="text-sm text-slate-300">Strict enforcement of <strong class="text-white">speed limits</strong> is crucial to reducing fatality rates.</p>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-2 h-2 rounded-full mt-1.5" style="background:#4ECDC4;"></div>
                        <p class="text-sm text-slate-300">Mandatory use of <strong class="text-white">seatbelts & helmets</strong> significantly lowers the risk of severe injury.</p>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-2 h-2 rounded-full mt-1.5" style="background:#45B7D1;"></div>
                        <p class="text-sm text-slate-300">Implementation of the <strong class="text-white">eDAR system</strong> (Electronic Detailed Accident Report) helps track real-time data.</p>
                    </div>
                </div>
                <a href="{{ route('eco-tips.index') }}" class="btn-ghost mt-6 text-center w-full justify-center">
                    Review Driving Tips
                </a>
            </div>
        </div>
    </div>

    <!-- CTA -->
    <div class="rounded-2xl p-8 text-center mt-12"
         style="background: linear-gradient(135deg, rgba(0,255,135,0.1), rgba(69,183,209,0.05)); border: 1px solid rgba(0,255,135,0.2);">
        <h2 class="text-2xl font-black text-white mb-3">Be part of the solution.</h2>
        <p class="text-slate-400 max-w-xl mx-auto mb-6">
            By driving smarter, adhering to safety regulations, and tracking your emissions, you can directly lower both your carbon footprint and the risk of road accidents.
        </p>
        <a href="{{ route('trips.create') }}" class="btn-primary">
            Log a Trip Safely
        </a>
    </div>

</div>
</x-app-layout>

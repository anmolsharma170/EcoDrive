<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>The EV Shift — Eco Drive</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { background: #0A0F1E; color: #E2E8F0; font-family: 'Inter', sans-serif; margin: 0; }
        .site-nav {
            background: rgba(8,12,23,0.85);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }
        .feature-card {
            background: rgba(15,22,41,0.6);
            border: 1px solid rgba(255,255,255,0.06);
            border-radius: 20px;
            padding: 32px;
            transition: all 0.3s;
        }
        .feature-card:hover {
            border-color: rgba(0,255,135,0.25);
            background: rgba(15,22,41,0.9);
            transform: translateY(-4px);
            box-shadow: 0 20px 60px rgba(0,0,0,0.4), 0 0 30px rgba(0,255,135,0.08);
        }
        .heading-gradient {
            background: linear-gradient(135deg,#00FF87 0%,#4ECDC4 50%,#45B7D1 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>
<body class="antialiased">

<!-- ── Navigation ─────────────────────────────────────────── -->
<nav class="site-nav fixed top-0 left-0 right-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-18 py-4">
            <!-- Logo -->
            <a href="/" class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl flex items-center justify-center" style="background: linear-gradient(135deg,#00FF87,#00C9A7);">
                    <svg class="w-5 h-5 text-[#0A0F1E]" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2a10 10 0 100 20A10 10 0 0012 2zm0 3a7 7 0 110 14A7 7 0 0112 5zm-1 3v5l4 2.5-.75-1.3L13 13V8h-2z"/></svg>
                </div>
                <span class="font-black text-xl text-white">Eco<span style="color:#00FF87">Drive</span></span>
            </a>

            <!-- Links -->
            <div class="hidden md:flex items-center gap-8">
                <!-- About Us Dropdown -->
                <div class="relative group">
                    <button class="text-slate-400 group-hover:text-white text-sm font-medium transition-colors flex items-center gap-1">
                        About Us
                        <svg class="w-4 h-4 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <!-- Dropdown Menu -->
                    <div class="absolute left-0 top-full pt-4 w-56 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                        <div class="rounded-xl p-2 site-nav shadow-xl border border-white/10" style="background: rgba(15,22,41,0.95);">
                            <a href="{{ route('about') }}#vision-mission" class="block px-4 py-2.5 text-sm text-slate-400 hover:text-white hover:bg-white/5 rounded-lg transition-colors">Vision and Mission</a>
                            <a href="{{ route('about') }}#principles" class="block px-4 py-2.5 text-sm text-slate-400 hover:text-white hover:bg-white/5 rounded-lg transition-colors">Our Principles</a>
                            <a href="{{ route('about') }}#members" class="block px-4 py-2.5 text-sm text-slate-400 hover:text-white hover:bg-white/5 rounded-lg transition-colors">Our Members</a>
                            <a href="{{ route('about') }}#history" class="block px-4 py-2.5 text-sm text-slate-400 hover:text-white hover:bg-white/5 rounded-lg transition-colors">Our History</a>
                        </div>
                    </div>
                </div>

                <!-- EV Dropdown -->
                <div class="relative group">
                    <button class="text-white group-hover:text-[#00FF87] text-sm font-medium transition-colors flex items-center gap-1">
                        Electric Vehicles
                        <svg class="w-4 h-4 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <!-- Dropdown Menu -->
                    <div class="absolute left-0 top-full pt-4 w-56 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                        <div class="rounded-xl p-2 site-nav shadow-xl border border-white/10" style="background: rgba(15,22,41,0.95);">
                            <a href="#why-ev" class="block px-4 py-2.5 text-sm text-slate-400 hover:text-white hover:bg-white/5 rounded-lg transition-colors">Why Switch?</a>
                            <a href="#advantages" class="block px-4 py-2.5 text-sm text-slate-400 hover:text-white hover:bg-white/5 rounded-lg transition-colors">Core Advantages</a>
                            <a href="#smart-tech" class="block px-4 py-2.5 text-sm text-slate-400 hover:text-white hover:bg-white/5 rounded-lg transition-colors">AI & Smart Tech</a>
                            <a href="#future" class="block px-4 py-2.5 text-sm text-slate-400 hover:text-white hover:bg-white/5 rounded-lg transition-colors">The Future</a>
                        </div>
                    </div>
                </div>

                <a href="/#features" class="text-slate-400 hover:text-white text-sm font-medium transition-colors">Features</a>
                <a href="/#how-it-works" class="text-slate-400 hover:text-white text-sm font-medium transition-colors">How it Works</a>
                <a href="/#testimonials" class="text-slate-400 hover:text-white text-sm font-medium transition-colors">Stories</a>
            </div>

            <!-- CTA -->
            <div class="flex items-center gap-3">
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn-primary">Go to Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-slate-400 hover:text-white text-sm font-medium transition-colors px-4">Log in</a>
                    @if(Route::has('register'))
                        <a href="{{ route('register') }}" class="btn-primary">Start Free →</a>
                    @endif
                @endauth
            </div>
        </div>
    </div>
</nav>

<!-- ── Main Content ───────────────────────────────────────── -->
<div class="pt-32 pb-24 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-32 relative">

    <!-- 1. The EV Shift / Why EV -->
    <section id="why-ev" class="scroll-mt-32 pt-8">
        <div class="flex flex-col lg:flex-row gap-16 items-center">
            <!-- Left Side: Persuasive Copy -->
            <div class="flex-1 lg:pr-8">
                <div class="text-xs font-bold uppercase tracking-widest mb-3" style="color:#00FF87;">The Inevitable Shift</div>
                <h2 class="text-5xl md:text-6xl font-black text-white mb-6 leading-tight" style="font-family: 'Plus Jakarta Sans', sans-serif; letter-spacing:-0.03em;">
                    Internal combustion belongs in a <span style="background: linear-gradient(135deg,#FF6B6B,#FF8E53); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text;">museum.</span>
                </h2>
                <p class="text-xl text-slate-400 mb-8 leading-relaxed">
                    Every time you start a petrol or diesel engine, you're burning money and polluting the air we all breathe. The future is electric, and the time to switch is right now.
                </p>
                <div class="flex items-center gap-4 p-5 rounded-2xl" style="background: rgba(0,255,135,0.05); border: 1px solid rgba(0,255,135,0.1);">
                    <div class="text-4xl">🔌</div>
                    <p class="text-slate-300 font-medium leading-relaxed">Over <strong class="text-white">40 million</strong> drivers have already made the switch globally. Don't be left behind driving outdated technology.</p>
                </div>
            </div>
            
            <div class="flex-1 w-full">
                <!-- Large graphic or placeholder -->
                <div class="aspect-video rounded-3xl w-full flex items-center justify-center relative overflow-hidden" style="background: linear-gradient(135deg, rgba(0,255,135,0.1), rgba(69,183,209,0.05)); border: 1px solid rgba(255,255,255,0.05);">
                    <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(#00FF87 1px, transparent 1px); background-size: 20px 20px;"></div>
                    <div class="text-center relative z-10">
                        <div class="text-6xl mb-4 animate-bounce">⚡</div>
                        <div class="text-lg font-bold text-white tracking-widest uppercase">The EV Era</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 2. Core Advantages -->
    <section id="advantages" class="scroll-mt-32">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-black text-white mb-4" style="letter-spacing:-0.02em;">
                Why shift to electric?
            </h2>
            <p class="text-slate-400 text-lg max-w-xl mx-auto">It's not just about the environment. EVs are objectively superior machines.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach([
                ['0 Tailpipe Emissions', 'Stop poisoning your city. EVs produce zero emissions, drastically shrinking your carbon footprint instantly.', '#00FF87', '🌍'],
                ['Slash Running Costs', 'Electricity is massively cheaper than fuel. With fewer moving parts, your maintenance costs basically drop to zero.', '#4ECDC4', '💰'],
                ['Instant Performance', 'Experience the thrill of 100% instant torque, dead-silent driving, and ultra-smooth gearless acceleration.', '#45B7D1', '⚡'],
                ['Massive Incentives', 'Governments are literally paying you to switch with tax breaks, subsidies, and free parking perks.', '#FFC107', '🎁']
            ] as $adv)
            <div class="feature-card relative overflow-hidden group">
                <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity text-6xl">
                    {{ $adv[3] }}
                </div>
                <h3 class="text-xl font-bold text-white mb-3 flex items-center gap-2">
                    <span style="color:{{ $adv[2] }};">•</span> {{ $adv[0] }}
                </h3>
                <p class="text-slate-400 text-sm leading-relaxed relative z-10">
                    {{ $adv[1] }}
                </p>
            </div>
            @endforeach
        </div>
    </section>

    <!-- 3. AI & Smart Tech -->
    <section id="smart-tech" class="scroll-mt-32">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-black text-white mb-4" style="letter-spacing:-0.02em;">
                More than just a car. It's a <span class="heading-gradient">Supercomputer.</span>
            </h2>
            <p class="text-slate-400 text-lg max-w-2xl mx-auto">Modern EVs are defined by their software. Internal combustion engines are mechanical; EVs are digital, autonomous, and intelligent.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- AI Self Driving -->
            <div class="feature-card" style="background: rgba(15,22,41,0.8); border-top: 4px solid #9C27B0;">
                <div class="text-5xl mb-6">🧠</div>
                <h3 class="text-2xl font-bold text-white mb-4">AI & Self-Driving</h3>
                <p class="text-slate-400 leading-relaxed mb-6">
                    Equipped with advanced neural networks, cameras, and LiDAR, many EVs offer Level 2+ autonomy. Your car can navigate highways, change lanes, and park itself while continuously learning from billions of miles of fleet data.
                </p>
                <div class="text-xs font-bold text-[#9C27B0] uppercase tracking-widest">Future-proof Autonomy</div>
            </div>

            <!-- OTA Updates -->
            <div class="feature-card" style="background: rgba(15,22,41,0.8); border-top: 4px solid #00BCD4;">
                <div class="text-5xl mb-6">📱</div>
                <h3 class="text-2xl font-bold text-white mb-4">Over-The-Air Updates</h3>
                <p class="text-slate-400 leading-relaxed mb-6">
                    Unlike traditional cars that depreciate the moment you buy them, an EV gets better over time. Wake up to new features, better battery efficiency, and improved infotainment systems via seamless Wi-Fi updates.
                </p>
                <div class="text-xs font-bold text-[#00BCD4] uppercase tracking-widest">Always Updating</div>
            </div>

            <!-- Regenerative Braking -->
            <div class="feature-card" style="background: rgba(15,22,41,0.8); border-top: 4px solid #00FF87;">
                <div class="text-5xl mb-6">♻️</div>
                <h3 class="text-2xl font-bold text-white mb-4">Regen & V2L</h3>
                <p class="text-slate-400 leading-relaxed mb-6">
                    Regenerative braking captures kinetic energy to recharge the battery as you slow down. Plus, Vehicle-to-Load (V2L) technology allows your EV to act as a massive power bank to run your house or camping equipment.
                </p>
                <div class="text-xs font-bold text-[#00FF87] uppercase tracking-widest">Energy Mastery</div>
            </div>
        </div>
    </section>

    <!-- 4. The Future CTA -->
    <section id="future" class="scroll-mt-32 pb-12">
        <div class="rounded-3xl p-12 text-center" style="background: linear-gradient(135deg, rgba(0,255,135,0.1), rgba(69,183,209,0.05)); border: 1px solid rgba(0,255,135,0.2);">
            <h2 class="text-3xl font-black text-white mb-4">Ready to track your transition?</h2>
            <p class="text-slate-400 max-w-xl mx-auto mb-8">
                Whether you already drive an EV or you're planning your next purchase, use Eco Drive to track your emissions, compare against combustion engines, and see your direct positive impact.
            </p>
            <a href="{{ route('register') }}" class="btn-primary text-lg px-8 py-4">Join the Movement</a>
        </div>
    </section>

</div>

<!-- ── Footer ─────────────────────────────────────────────── -->
<footer style="background: #080C17; border-top: 1px solid rgba(255,255,255,0.05);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-xl flex items-center justify-center" style="background: linear-gradient(135deg,#00FF87,#00C9A7);">
                    <svg class="w-4 h-4 text-[#0A0F1E]" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2a10 10 0 100 20A10 10 0 0012 2zm0 3a7 7 0 110 14A7 7 0 0112 5zm-1 3v5l4 2.5-.75-1.3L13 13V8h-2z"/></svg>
                </div>
                <span class="font-black text-lg text-white">Eco<span style="color:#00FF87">Drive</span></span>
                <span class="text-slate-600 text-sm">© {{ date('Y') }}</span>
            </div>
            <div class="flex gap-6">
                <a href="#" class="text-slate-500 hover:text-white text-sm transition-colors">Privacy</a>
                <a href="#" class="text-slate-500 hover:text-white text-sm transition-colors">Terms</a>
                <a href="#" class="text-slate-500 hover:text-white text-sm transition-colors">Contact</a>
            </div>
        </div>
    </div>
</footer>

</body>
</html>

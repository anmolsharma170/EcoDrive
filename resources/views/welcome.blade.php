<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Eco Drive — Drive Smart. Save the Planet. Earn Rewards.</title>
    <meta name="description" content="Every km you drive pollutes. Eco Drive helps you track, reduce, and offset your carbon footprint — and compete with others to drive greener.">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { background: #0A0F1E; color: #E2E8F0; font-family: 'Inter', sans-serif; margin: 0; }

        /* Animated background orbs */
        .hero-orb-1 {
            position: absolute; width: 600px; height: 600px; border-radius: 50%;
            background: radial-gradient(circle, rgba(0,255,135,0.08) 0%, transparent 70%);
            top: -100px; left: -100px; pointer-events: none;
            animation: float-orb 8s ease-in-out infinite;
        }
        .hero-orb-2 {
            position: absolute; width: 500px; height: 500px; border-radius: 50%;
            background: radial-gradient(circle, rgba(69,183,209,0.06) 0%, transparent 70%);
            bottom: -50px; right: -50px; pointer-events: none;
            animation: float-orb 10s ease-in-out infinite reverse;
        }
        @keyframes float-orb {
            0%,100% { transform: translate(0,0) scale(1); }
            50%      { transform: translate(20px,20px) scale(1.05); }
        }

        /* Stat counter animation */
        .count-up { opacity: 0; animation: countIn 0.8s ease-out forwards; }
        @keyframes countIn {
            from { opacity:0; transform: translateY(16px); }
            to   { opacity:1; transform: translateY(0); }
        }

        /* Testimonial card */
        .testimonial-card {
            background: rgba(15,22,41,0.7);
            border: 1px solid rgba(255,255,255,0.07);
            border-radius: 20px;
            padding: 28px;
            backdrop-filter: blur(12px);
            transition: all 0.3s;
        }
        .testimonial-card:hover {
            border-color: rgba(0,255,135,0.2);
            transform: translateY(-4px);
        }

        /* Feature card */
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

        /* Sticky nav */
        .site-nav {
            background: rgba(8,12,23,0.85);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }
    </style>
</head>
<body>

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
                    <button class="text-slate-400 group-hover:text-white text-sm font-medium transition-colors flex items-center gap-1">
                        Electric Vehicles
                        <svg class="w-4 h-4 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <!-- Dropdown Menu -->
                    <div class="absolute left-0 top-full pt-4 w-56 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                        <div class="rounded-xl p-2 site-nav shadow-xl border border-white/10" style="background: rgba(15,22,41,0.95);">
                            <a href="{{ route('ev') }}#why-ev" class="block px-4 py-2.5 text-sm text-slate-400 hover:text-white hover:bg-white/5 rounded-lg transition-colors">Why Switch?</a>
                            <a href="{{ route('ev') }}#advantages" class="block px-4 py-2.5 text-sm text-slate-400 hover:text-white hover:bg-white/5 rounded-lg transition-colors">Core Advantages</a>
                            <a href="{{ route('ev') }}#smart-tech" class="block px-4 py-2.5 text-sm text-slate-400 hover:text-white hover:bg-white/5 rounded-lg transition-colors">AI & Smart Tech</a>
                            <a href="{{ route('ev') }}#future" class="block px-4 py-2.5 text-sm text-slate-400 hover:text-white hover:bg-white/5 rounded-lg transition-colors">The Future</a>
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

<!-- ── Hero Section ───────────────────────────────────────── -->
<section class="relative min-h-screen flex items-center pt-20 overflow-hidden" style="background: radial-gradient(ellipse at 20% 30%, rgba(0,255,135,0.1) 0%, transparent 50%), radial-gradient(ellipse at 80% 70%, rgba(69,183,209,0.07) 0%, transparent 50%), #0A0F1E;">
    <div class="hero-orb-1"></div>
    <div class="hero-orb-2"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 relative z-10">
        <div class="max-w-4xl mx-auto text-center">
            <!-- Badge -->
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-xs font-semibold mb-8"
                 style="background: rgba(0,255,135,0.1); border: 1px solid rgba(0,255,135,0.2); color: #00FF87;">
                <span class="w-2 h-2 rounded-full animate-pulse" style="background:#00FF87;"></span>
                🌍 {{ number_format($stats['total_users']) }}+ eco drivers already joined
            </div>

            <!-- Headline -->
            <h1 class="text-5xl md:text-7xl font-black text-white leading-tight mb-6" style="font-family: 'Plus Jakarta Sans', sans-serif; letter-spacing: -0.03em;">
                Drive Smart.<br>
                <span style="background: linear-gradient(135deg,#00FF87 0%,#4ECDC4 50%,#45B7D1 100%); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text;">
                    Save the Planet.
                </span><br>
                Earn Rewards.
            </h1>

            <p class="text-lg md:text-xl text-slate-400 max-w-2xl mx-auto mb-10 leading-relaxed">
                Every km you drive pollutes. <strong class="text-slate-200">Eco Drive</strong> helps you track, reduce, and offset your carbon footprint — and <strong class="text-slate-200">compete with others</strong> to drive greener.
            </p>

            <!-- CTAs -->
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mb-16">
                <a href="{{ route('register') }}" class="btn-primary text-base px-8 py-4">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    Start Tracking Free
                </a>
                <a href="#how-it-works" class="btn-ghost text-base px-8 py-4">
                    See How it Works →
                </a>
            </div>

            <!-- Live Platform Stats -->
            <div class="grid grid-cols-3 gap-6 max-w-2xl mx-auto">
                <div class="count-up delay-100">
                    <div class="text-3xl md:text-4xl font-black" style="color:#00FF87;"
                         data-target="{{ number_format($stats['total_co2_saved'], 1) }}">
                        {{ number_format($stats['total_co2_saved'], 1) }}
                    </div>
                    <div class="text-xs text-slate-500 mt-1 font-medium">kg CO₂ saved</div>
                </div>
                <div class="count-up delay-200">
                    <div class="text-3xl md:text-4xl font-black text-white">
                        {{ number_format($stats['total_trips']) }}+
                    </div>
                    <div class="text-xs text-slate-500 mt-1 font-medium">trips logged</div>
                </div>
                <div class="count-up delay-300">
                    <div class="text-3xl md:text-4xl font-black" style="color:#45B7D1;">
                        {{ number_format($stats['total_users']) }}+
                    </div>
                    <div class="text-xs text-slate-500 mt-1 font-medium">eco drivers</div>
                </div>
            </div>
        </div>

        <!-- Floating mockup card -->
        <div class="mt-20 max-w-3xl mx-auto">
            <div class="rounded-2xl p-1" style="background: linear-gradient(135deg, rgba(0,255,135,0.3), rgba(69,183,209,0.2), rgba(255,255,255,0.05));">
                <div class="rounded-xl p-6" style="background: #080C17;">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-3 h-3 rounded-full bg-red-500"></div>
                        <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
                        <div class="w-3 h-3 rounded-full bg-green-500"></div>
                        <span class="ml-3 text-xs text-slate-600 font-mono">eco-drive dashboard</span>
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                        @foreach([['Eco Score','850 pts','↑12%','#00FF87'], ['CO₂ Saved','45.5 kg','this month','#4ECDC4'], ['Your Rank','#3','top 5%','#45B7D1'], ['Streak','6 days','🔥 keep going','#FFC107']] as $card)
                        <div class="rounded-xl p-4" style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.05);">
                            <div class="text-xs text-slate-500 mb-2">{{ $card[0] }}</div>
                            <div class="text-xl font-black" style="color:{{ $card[2] === '↑12%' ? $card[3] : 'white' }};">{{ $card[1] }}</div>
                            <div class="text-xs mt-1" style="color:{{ $card[3] }};">{{ $card[2] }}</div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ── How it Works ───────────────────────────────────────── -->
<section id="how-it-works" class="py-24" style="background: #080C17;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <div class="text-xs font-bold uppercase tracking-widest mb-3" style="color:#00FF87;">How It Works</div>
            <h2 class="text-4xl md:text-5xl font-black text-white mb-4" style="letter-spacing:-0.02em;">
                Three steps to greener driving
            </h2>
            <p class="text-slate-400 text-lg max-w-xl mx-auto">No hardware needed. Just your phone and a commitment to drive smarter.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach([
                ['01','Log Your Trip','Enter distance and fuel type — we instantly calculate your exact CO₂ footprint per trip.','🚗','#00FF87'],
                ['02','See Your Impact','Your personal dashboard shows weekly trends, eco grade A–F, and how many trees you\'ve saved.','📊','#4ECDC4'],
                ['03','Compete & Improve','Climb the leaderboard, unlock achievement badges, and challenge friends to drive greener.','🏆','#45B7D1'],
            ] as $step)
            <div class="feature-card text-center">
                <div class="text-5xl mb-4">{{ $step[3] }}</div>
                <div class="text-xs font-bold uppercase tracking-widest mb-2" style="color:{{ $step[4] }};">Step {{ $step[0] }}</div>
                <h3 class="text-xl font-bold text-white mb-3">{{ $step[1] }}</h3>
                <p class="text-slate-400 leading-relaxed">{{ $step[2] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ── Features ───────────────────────────────────────────── -->
<section id="features" class="py-24" style="background: #0A0F1E;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <div class="text-xs font-bold uppercase tracking-widest mb-3" style="color:#00FF87;">Features</div>
            <h2 class="text-4xl md:text-5xl font-black text-white mb-4" style="letter-spacing:-0.02em;">
                Built for serious eco drivers
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach([
                ['⚡','Real-time CO₂ Calculation','Instant emission estimates as you type. Based on fuel type, vehicle, and distance.','#00FF87'],
                ['📈','Weekly Progress Charts','Beautiful Chart.js visualizations showing your CO₂ trend over time.','#4ECDC4'],
                ['🏅','Achievement Badges','Unlock badges like "First Green Trip", "100km Club", and "Low Carbon Hero".','#FFC107'],
                ['🔥','Daily Streak Counter','Build momentum with a Duolingo-style streak for consecutive days of eco driving.','#FF6B6B'],
                ['🏆','Global Leaderboard','See where you rank against all Eco Drive users. Updated in real-time.','#45B7D1'],
                ['🌱','Tree Impact Visualizer','See how many trees worth of CO₂ you\'ve saved — emotional and real.','#96CEB4'],
            ] as $feat)
            <div class="feature-card">
                <div class="text-3xl mb-4">{{ $feat[0] }}</div>
                <h3 class="text-lg font-bold text-white mb-2">{{ $feat[1] }}</h3>
                <p class="text-slate-400 text-sm leading-relaxed">{{ $feat[2] }}</p>
                <div class="mt-4 h-0.5 w-12 rounded-full" style="background:{{ $feat[3] }};"></div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ── Testimonials ───────────────────────────────────────── -->
<section id="testimonials" class="py-24" style="background: #080C17;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <div class="text-xs font-bold uppercase tracking-widest mb-3" style="color:#00FF87;">Real Stories</div>
            <h2 class="text-4xl md:text-5xl font-black text-white mb-4" style="letter-spacing:-0.02em;">
                Drivers who made the switch
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach([
                ['Arjun S.', 'Mumbai, Maharashtra', 'A', 'I cut my monthly CO₂ by 34% in just 6 weeks. Seeing my score go up is genuinely addictive — like Strava but for the planet.', '⭐⭐⭐⭐⭐', '#00FF87'],
                ['Priya N.', 'Bangalore, Karnataka', 'A+', 'The weekly charts showed me I was wasting fuel in stop-and-go traffic. Changed my commute route and saved ₹800/month on fuel!', '⭐⭐⭐⭐⭐', '#4ECDC4'],
                ['Rahul M.', 'Delhi, NCR', 'B', 'Unlocking the "Green Week" badge after 7 consecutive low-emission days was so satisfying. My team at work started a leaderboard competition!', '⭐⭐⭐⭐⭐', '#45B7D1'],
            ] as $t)
            <div class="testimonial-card">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-11 h-11 rounded-full flex items-center justify-center font-bold text-[#0A0F1E] flex-shrink-0"
                         style="background: linear-gradient(135deg, {{ $t[5] }}, rgba(255,255,255,0.5));">
                        {{ strtoupper(substr($t[0], 0, 2)) }}
                    </div>
                    <div>
                        <div class="font-bold text-white text-sm">{{ $t[0] }}</div>
                        <div class="text-xs text-slate-500">{{ $t[1] }}</div>
                    </div>
                    <div class="ml-auto px-2 py-1 rounded-lg text-xs font-black text-[#0A0F1E]"
                         style="background:{{ $t[5] }};">
                        Grade {{ $t[2] }}
                    </div>
                </div>
                <p class="text-slate-300 text-sm leading-relaxed mb-4">"{{ $t[3] }}"</p>
                <div class="text-sm">{{ $t[4] }}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ── CTA Section ────────────────────────────────────────── -->
<section class="py-24 relative overflow-hidden" style="background: radial-gradient(ellipse at center, rgba(0,255,135,0.12) 0%, transparent 70%), #0A0F1E;">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <div class="text-5xl mb-6">🌍</div>
        <h2 class="text-4xl md:text-5xl font-black text-white mb-6" style="letter-spacing:-0.02em;">
            Ready to drive greener?
        </h2>
        <p class="text-lg text-slate-400 mb-10">
            Join thousands of eco drivers tracking their carbon footprint — and making a real difference, one km at a time.
        </p>
        <a href="{{ route('register') }}" class="btn-primary text-lg px-10 py-5">
            Start Tracking Free — No Card Needed
        </a>
        <p class="mt-4 text-sm text-slate-600">Takes 30 seconds to sign up. Cancel anytime.</p>
    </div>
</section>

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

<script>
// Intersection Observer for count-up animations
const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.animationPlayState = 'running';
        }
    });
}, { threshold: 0.1 });

document.querySelectorAll('.count-up').forEach(el => {
    el.style.animationPlayState = 'paused';
    observer.observe(el);
});
</script>
</body>
</html>

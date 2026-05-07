<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>About Us — Eco Drive</title>

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
        .section-card {
            background: rgba(15,22,41,0.6);
            border: 1px solid rgba(255,255,255,0.06);
            border-radius: 20px;
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
                    <button class="text-white group-hover:text-[#00FF87] text-sm font-medium transition-colors flex items-center gap-1">
                        About Us
                        <svg class="w-4 h-4 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <!-- Dropdown Menu -->
                    <div class="absolute left-0 top-full pt-4 w-56 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                        <div class="rounded-xl p-2 site-nav shadow-xl border border-white/10" style="background: rgba(15,22,41,0.95);">
                            <a href="#vision-mission" class="block px-4 py-2.5 text-sm text-slate-400 hover:text-white hover:bg-white/5 rounded-lg transition-colors">Vision and Mission</a>
                            <a href="#principles" class="block px-4 py-2.5 text-sm text-slate-400 hover:text-white hover:bg-white/5 rounded-lg transition-colors">Our Principles</a>
                            <a href="#members" class="block px-4 py-2.5 text-sm text-slate-400 hover:text-white hover:bg-white/5 rounded-lg transition-colors">Our Members</a>
                            <a href="#history" class="block px-4 py-2.5 text-sm text-slate-400 hover:text-white hover:bg-white/5 rounded-lg transition-colors">Our History</a>
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

<!-- ── Main Content ───────────────────────────────────────── -->
<div class="pt-32 pb-24 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-24 relative" style="background: radial-gradient(ellipse at top, rgba(0,255,135,0.05) 0%, transparent 60%);">

    <!-- Header -->
    <div class="text-center pt-8">
        <h1 class="text-5xl font-black text-white mb-6" style="font-family: 'Plus Jakarta Sans', sans-serif; letter-spacing: -0.02em;">
            About <span class="heading-gradient">Eco Drive</span>
        </h1>
        <p class="text-xl text-slate-400 max-w-2xl mx-auto">
            Driving the automotive industry towards a sustainable, collaborative, and innovative future.
        </p>
    </div>

    <!-- 1. Vision and Mission -->
    <section id="vision-mission" class="scroll-mt-32">
        <div class="section-card p-8 md:p-14">
            <!-- Vision -->
            <div>
                <div class="text-sm font-bold uppercase tracking-widest mb-4" style="color:#00FF87;">Our Vision</div>
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-8 leading-tight">Leading the transformation towards a circular and sustainable automotive value chain.</h2>
                <div class="space-y-6 text-slate-300 text-lg leading-relaxed">
                    <p>
                        We endeavour to achieve excellence, innovation, and performance in a sustainable manner. People and the environment are the automotive industry's most important resources.
                    </p>
                    <p>
                        It is of great importance for us that the individuals making vehicles, components, or providing services are afforded decent working conditions and are treated with dignity and respect, while minimising the environmental impact of the industry and promoting business integrity.
                    </p>
                </div>
            </div>

            <div class="h-px w-full my-16" style="background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);"></div>

            <!-- Mission -->
            <div>
                <div class="text-sm font-bold uppercase tracking-widest mb-4" style="color:#4ECDC4;">Our Mission</div>
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-8 leading-tight">Driving sustainability by leveraging a common voice.</h2>
                <div class="space-y-6 text-slate-300 text-lg leading-relaxed">
                    <p>
                        We are a leading partnership that is based on strong collaboration, innovation and impact. Drive Sustainability brings together global automotive companies that commit to improve both their own performance and that of their supply chain by integrating sustainability in the overall procurement process.
                    </p>
                    <p>
                        We understand supply chains are global, therefore we act as a strong promoter of standardization and harmonization of supply chain approaches to achieve long term impact, while also maintaining independent supply chain management.
                    </p>
                    <p>
                        The automotive industry has complex value chains and a deep structured supplier base. We work in a harmonised approach towards supply chain sustainability to leverage our individual company efforts and develop joint solutions to our common challenges.
                    </p>
                    <p>
                        To succeed we rely on commitment from the entire supply chain. We strive for collaboration and work closely with our suppliers and other stakeholders to achieve our mission. Success, impact and scale are possible only if all actors join forces. We are open about our achievements and challenges alike.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- 2. Our Principles -->
    <section id="principles" class="scroll-mt-32">
        <div class="section-card p-8 md:p-14">
            <div class="text-sm font-bold uppercase tracking-widest mb-4" style="color:#FFC107;">Our Principles</div>
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-10 leading-tight">Our Common Direction</h2>
            <div class="space-y-6">
                @foreach([
                    'Have a common and unified position, understanding and commitment to supply chain sustainability towards suppliers, other partners, and stakeholders.',
                    'Develop and implement common activities & tools that can drive changes and impact.',
                    'Encourage, promote and work together to have a common approach and process on supply chain sustainability throughout the industry.',
                    'Strive to embed sustainability into company procurement processes throughout the industry.'
                ] as $principle)
                <div class="flex items-start gap-4">
                    <div class="w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0 mt-1" style="background: rgba(255,193,7,0.1); color:#FFC107;">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z"/></svg>
                    </div>
                    <p class="text-lg text-slate-300 leading-relaxed">{{ $principle }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- 3. Our Members -->
    <section id="members" class="scroll-mt-32">
        <div class="text-center mb-10">
            <div class="text-xs font-bold uppercase tracking-widest mb-3" style="color:#45B7D1;">Our Members</div>
            <h2 class="text-3xl font-bold text-white mb-4">Driving change together</h2>
            <p class="text-slate-400">We partner with leading global automobile brands to standardize supply chain sustainability.</p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @foreach([
                'Toyota', 'Volkswagen', 'Ford', 'Honda', 
                'Hyundai', 'General Motors', 'Nissan', 'BMW', 
                'Mercedes-Benz', 'Tesla', 'Volvo', 'Tata Motors'
            ] as $brand)
            <div class="p-6 rounded-xl text-center font-bold text-lg transition-all duration-300 hover:-translate-y-1 hover:bg-white/10"
                 style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); color: #E2E8F0;">
                {{ $brand }}
            </div>
            @endforeach
        </div>
    </section>

    <!-- 4. Our History -->
    <section id="history" class="scroll-mt-32">
        <div class="section-card p-8 md:p-14 border-l-4" style="border-left-color: #00FF87;">
            <div class="text-sm font-bold uppercase tracking-widest mb-4" style="color:#00FF87;">Our History</div>
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-8 leading-tight">A Journey of Collaboration</h2>
            <div class="space-y-6 text-slate-300 text-lg leading-relaxed">
                <p>
                    Eco Drive began as a shared vision among forward-thinking industry leaders who recognized that true sustainability cannot be achieved in isolation. 
                    Understanding that the automotive supply chain is deeply interconnected, our founding members came together to create a unified framework for environmental responsibility.
                </p>
                <p>
                    Over the years, we have grown from a localized initiative into a global partnership. By aligning our procurement processes, establishing common benchmarks, and championing transparency, we have successfully begun the monumental task of lowering the industry's carbon footprint. Today, our coalition stands as a testament to the power of collective action in the fight against climate change.
                </p>
            </div>
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

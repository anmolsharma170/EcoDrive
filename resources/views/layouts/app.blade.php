<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Eco Drive — Track, reduce, and offset your carbon footprint while driving. Compete with others to drive greener.">
    <title>{{ config('app.name', 'Eco Drive') }} — @yield('title', 'Dashboard')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { background-color: #0A0F1E; }
    </style>
</head>
<body class="font-sans antialiased bg-[#0A0F1E] text-slate-200 min-h-screen">

    <div class="flex h-screen overflow-hidden">

        <!-- ── Sidebar Navigation ─────────────────────────────── -->
        <aside id="sidebar"
               class="fixed inset-y-0 left-0 z-50 w-64 flex flex-col border-r border-white/5 transform transition-transform duration-300 lg:relative lg:translate-x-0"
               style="background: #080C17;">

            <!-- Logo -->
            <div class="flex items-center gap-3 px-6 py-6 border-b border-white/5">
                <div class="w-9 h-9 rounded-xl flex items-center justify-center flex-shrink-0" style="background: linear-gradient(135deg,#00FF87,#00C9A7);">
                    <svg class="w-5 h-5 text-[#0A0F1E]" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2a10 10 0 100 20A10 10 0 0012 2zm0 3a7 7 0 110 14A7 7 0 0112 5zm-1 3v5l4 2.5-.75-1.3L13 13V8h-2z"/></svg>
                </div>
                <div>
                    <span class="font-black text-lg text-white tracking-tight">Eco<span style="color:#00FF87">Drive</span></span>
                    <p class="text-xs text-slate-500 font-medium">Carbon Tracker</p>
                </div>
            </div>

            <!-- Nav Links -->
            <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">
                <a href="{{ route('dashboard') }}"
                   class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    Dashboard
                </a>

                <a href="{{ route('trips.create') }}"
                   class="nav-link {{ request()->routeIs('trips.create') ? 'active' : '' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Log a Trip
                </a>

                <a href="{{ route('trips.index') }}"
                   class="nav-link {{ request()->routeIs('trips.index') ? 'active' : '' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    My Trips
                </a>

                <a href="{{ route('leaderboard.index') }}"
                   class="nav-link {{ request()->routeIs('leaderboard.*') ? 'active' : '' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    Leaderboard
                </a>

                <a href="{{ route('insights.index') }}"
                   class="nav-link {{ request()->routeIs('insights.*') ? 'active' : '' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Global Insights
                </a>

                <a href="{{ route('eco-tips.index') }}"
                   class="nav-link {{ request()->routeIs('eco-tips.*') ? 'active' : '' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
                    Eco Tips
                </a>

                <a href="{{ route('vehicles.index') }}"
                   class="nav-link {{ request()->routeIs('vehicles.*') ? 'active' : '' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/></svg>
                    My Vehicles
                </a>

                <div class="pt-4 mt-4 border-t border-white/5">
                    <a href="{{ route('profile.edit') }}"
                       class="nav-link {{ request()->routeIs('profile.*') ? 'active' : '' }}">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        Profile
                    </a>
                </div>
            </nav>

            <!-- User Info at Bottom -->
            <div class="p-4 border-t border-white/5">
                <div class="flex items-center gap-3 p-3 rounded-xl" style="background: rgba(0,255,135,0.05); border: 1px solid rgba(0,255,135,0.1);">
                    <div class="w-9 h-9 rounded-full flex items-center justify-center text-sm font-bold text-[#0A0F1E] flex-shrink-0"
                         style="background: linear-gradient(135deg,#00FF87,#00C9A7);">
                        {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                    </div>
                    <div class="overflow-hidden">
                        <p class="text-sm font-semibold text-white truncate">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-slate-500">{{ auth()->user()->eco_grade }} Grade</p>
                    </div>
                    <form method="POST" action="{{ route('logout') }}" class="ml-auto">
                        @csrf
                        <button type="submit" class="text-slate-500 hover:text-red-400 transition-colors" title="Logout">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- ── Main Content ────────────────────────────────────── -->
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden">

            <!-- Top Bar -->
            <header class="flex items-center justify-between px-6 py-4 border-b border-white/5 lg:hidden" style="background: #080C17;">
                <span class="font-black text-lg text-white">Eco<span style="color:#00FF87">Drive</span></span>
                <button id="sidebar-toggle" onclick="toggleSidebar()" class="text-slate-400 hover:text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
            </header>

            <!-- Flash Messages -->
            @if(session('success'))
            <div class="mx-6 mt-4 p-4 rounded-xl flex items-center gap-3 text-sm font-medium animate-slide-up"
                 style="background: rgba(0,255,135,0.1); border: 1px solid rgba(0,255,135,0.3); color: #00FF87;">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ session('success') }}
            </div>
            @endif

            @if(session('error'))
            <div class="mx-6 mt-4 p-4 rounded-xl flex items-center gap-3 text-sm font-medium"
                 style="background: rgba(244,67,54,0.1); border: 1px solid rgba(244,67,54,0.3); color: #FF5722;">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ session('error') }}
            </div>
            @endif

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto p-6">
                {{ $slot }}
            </main>
        </div>
    </div>

    <!-- Overlay for mobile sidebar -->
    <div id="sidebar-overlay" class="fixed inset-0 bg-black/60 z-40 hidden lg:hidden" onclick="toggleSidebar()"></div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }
        // Hide sidebar on mobile by default
        if (window.innerWidth < 1024) {
            document.getElementById('sidebar').classList.add('-translate-x-full');
        }
    </script>
</body>
</html>

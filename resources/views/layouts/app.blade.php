<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Eco Drive') }} — @yield('title', 'Dashboard')</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --eco-green:     #22c55e;
            --eco-dark:      #15803d;
            --eco-light:     #dcfce7;
            --eco-sidebar:   #0f172a;
            --eco-card:      #1e293b;
            --eco-text:      #f8fafc;
            --eco-muted:     #94a3b8;
        }
        * { font-family: 'Inter', sans-serif; }
        body { background: #0f172a; color: var(--eco-text); min-height: 100vh; display: flex; flex-direction: column; }

        /* Sidebar */
        .sidebar {
            width: 260px; min-height: 100vh;
            background: var(--eco-card);
            border-right: 1px solid rgba(255,255,255,.05);
            position: fixed; top: 0; left: 0; z-index: 100;
            display: flex; flex-direction: column;
            transition: transform .3s;
        }
        .sidebar-brand {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(255,255,255,.05);
        }
        .brand-logo { font-size: 1.4rem; font-weight: 700; color: var(--eco-green); }
        .brand-logo i { margin-right: .4rem; }
        .sidebar-nav { padding: 1rem 0; flex: 1; }
        .nav-section { padding: .5rem 1.2rem; font-size: .7rem; color: var(--eco-muted); text-transform: uppercase; letter-spacing: .1em; font-weight: 600; }
        .nav-link-item {
            display: flex; align-items: center; gap: .75rem;
            padding: .65rem 1.4rem; color: var(--eco-muted);
            text-decoration: none; font-size: .9rem; font-weight: 500;
            border-radius: 8px; margin: .1rem .8rem;
            transition: all .2s;
        }
        .nav-link-item:hover, .nav-link-item.active {
            background: rgba(34,197,94,.12);
            color: var(--eco-green);
        }
        .nav-link-item i { font-size: 1rem; width: 20px; text-align: center; }

        /* Main content */
        .main-content { margin-left: 260px; flex: 1; padding: 2rem; }

        /* Top bar */
        .top-bar {
            background: var(--eco-card); border-bottom: 1px solid rgba(255,255,255,.05);
            padding: .9rem 2rem; margin: -2rem -2rem 2rem;
            display: flex; align-items: center; justify-content: space-between;
        }
        .top-bar-title { font-size: 1.1rem; font-weight: 600; }
        .user-pill {
            display: flex; align-items: center; gap: .6rem;
            background: rgba(255,255,255,.05); border-radius: 50px;
            padding: .4rem 1rem; font-size: .85rem;
        }
        .user-avatar {
            width: 30px; height: 30px; border-radius: 50%;
            background: var(--eco-dark);
            display: flex; align-items: center; justify-content: center;
            font-size: .8rem; font-weight: 600; color: var(--eco-green);
        }

        /* Cards */
        .eco-card {
            background: var(--eco-card); border-radius: 16px;
            border: 1px solid rgba(255,255,255,.06);
            padding: 1.5rem; transition: transform .2s, box-shadow .2s;
        }
        .eco-card:hover { transform: translateY(-2px); box-shadow: 0 8px 30px rgba(0,0,0,.3); }
        .stat-card-icon {
            width: 50px; height: 50px; border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.4rem;
        }
        .stat-value { font-size: 2rem; font-weight: 700; }
        .stat-label { color: var(--eco-muted); font-size: .85rem; }

        /* Badges */
        .badge-green  { background: rgba(34,197,94,.15);  color: var(--eco-green); border-radius: 50px; padding: .3rem .8rem; font-size: .78rem; font-weight: 600; }
        .badge-yellow { background: rgba(234,179,8,.15);  color: #eab308; border-radius: 50px; padding: .3rem .8rem; font-size: .78rem; font-weight: 600; }
        .badge-blue   { background: rgba(59,130,246,.15); color: #60a5fa; border-radius: 50px; padding: .3rem .8rem; font-size: .78rem; font-weight: 600; }
        .badge-red    { background: rgba(239,68,68,.15);  color: #f87171; border-radius: 50px; padding: .3rem .8rem; font-size: .78rem; font-weight: 600; }

        /* Tables */
        .eco-table { width: 100%; border-collapse: separate; border-spacing: 0; }
        .eco-table th { color: var(--eco-muted); font-size: .78rem; text-transform: uppercase; letter-spacing: .06em; padding: .75rem 1rem; font-weight: 600; }
        .eco-table td { padding: .9rem 1rem; border-bottom: 1px solid rgba(255,255,255,.04); font-size: .9rem; }
        .eco-table tbody tr:hover { background: rgba(255,255,255,.03); }

        /* Forms */
        .form-control, .form-select {
            background: rgba(255,255,255,.05) !important;
            border: 1px solid rgba(255,255,255,.1) !important;
            color: var(--eco-text) !important;
            border-radius: 10px;
        }
        .form-control:focus, .form-select:focus {
            box-shadow: 0 0 0 3px rgba(34,197,94,.2) !important;
            border-color: var(--eco-green) !important;
        }
        .form-label { color: var(--eco-muted); font-size: .85rem; font-weight: 500; margin-bottom: .4rem; }
        .btn-eco {
            background: var(--eco-green); color: #000; font-weight: 600;
            border: none; border-radius: 10px; padding: .65rem 1.5rem;
            transition: background .2s, transform .1s;
        }
        .btn-eco:hover { background: var(--eco-dark); color: #fff; transform: translateY(-1px); }
        .btn-danger-eco { background: rgba(239,68,68,.15); color: #f87171; border: 1px solid rgba(239,68,68,.2); border-radius: 8px; font-size: .8rem; padding: .3rem .7rem; }
        .btn-danger-eco:hover { background: rgba(239,68,68,.3); color: #fff; }

        /* Alert */
        .alert-eco { background: rgba(34,197,94,.1); border: 1px solid rgba(34,197,94,.3); color: var(--eco-green); border-radius: 12px; }
        .alert-danger-eco { background: rgba(239,68,68,.1); border: 1px solid rgba(239,68,68,.3); color: #f87171; border-radius: 12px; }
        .alert-warning-eco { background: rgba(234,179,8,.1); border: 1px solid rgba(234,179,8,.3); color: #fbbf24; border-radius: 12px; }

        /* Mobile */
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .main-content { margin-left: 0; padding: 1rem; }
            .top-bar { margin: -1rem -1rem 1rem; }
        }

        /* Leaderboard */
        .rank-badge {
            width: 36px; height: 36px; border-radius: 50%;
            display: inline-flex; align-items: center; justify-content: center;
            font-weight: 700; font-size: .9rem;
        }
        .rank-1 { background: linear-gradient(135deg, #fbbf24, #f59e0b); color: #000; }
        .rank-2 { background: linear-gradient(135deg, #9ca3af, #6b7280); color: #fff; }
        .rank-3 { background: linear-gradient(135deg, #b45309, #92400e); color: #fff; }
        .rank-other { background: rgba(255,255,255,.1); color: var(--eco-muted); }

        /* Page header */
        .page-header { margin-bottom: 2rem; }
        .page-header h1 { font-size: 1.6rem; font-weight: 700; margin-bottom: .3rem; }
        .page-header p  { color: var(--eco-muted); margin: 0; font-size: .9rem; }

        /* Tip card */
        .tip-card { border-left: 3px solid var(--eco-green); }
        .tip-icon { font-size: 2rem; }

        /* Progress ring */
        .eco-score-ring { position: relative; display: inline-flex; align-items: center; justify-content: center; }
    </style>
    @stack('styles')
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-brand">
            <div class="brand-logo"><i class="bi bi-leaf-fill"></i>Eco Drive</div>
            <div style="font-size:.75rem; color: var(--eco-muted); margin-top:.25rem;">Sustainable Driving Platform</div>
        </div>
        <nav class="sidebar-nav">
            <div class="nav-section">Main</div>
            <a href="{{ route('dashboard') }}" class="nav-link-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
            <a href="{{ route('trips.index') }}" class="nav-link-item {{ request()->routeIs('trips.*') ? 'active' : '' }}">
                <i class="bi bi-map"></i> Trip Logger
            </a>
            <a href="{{ route('vehicles.index') }}" class="nav-link-item {{ request()->routeIs('vehicles.*') ? 'active' : '' }}">
                <i class="bi bi-car-front"></i> My Vehicles
            </a>

            <div class="nav-section mt-2">Eco</div>
            <a href="{{ route('leaderboard.index') }}" class="nav-link-item {{ request()->routeIs('leaderboard.*') ? 'active' : '' }}">
                <i class="bi bi-trophy"></i> Leaderboard
            </a>
            <a href="{{ route('tips.index') }}" class="nav-link-item {{ request()->routeIs('tips.*') ? 'active' : '' }}">
                <i class="bi bi-lightbulb"></i> Eco Tips
            </a>

            @if(Auth::user()->isAdmin())
            <div class="nav-section mt-2">Admin</div>
            <a href="{{ route('admin.dashboard') }}" class="nav-link-item {{ request()->routeIs('admin.*') ? 'active' : '' }}">
                <i class="bi bi-shield-check"></i> Admin Panel
            </a>
            @endif

            <div class="nav-section mt-2">Account</div>
            <a href="{{ route('profile.edit') }}" class="nav-link-item">
                <i class="bi bi-person-circle"></i> Profile
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="nav-link-item w-100 border-0 bg-transparent text-start" style="cursor:pointer;">
                    <i class="bi bi-box-arrow-left"></i> Logout
                </button>
            </form>
        </nav>

        <!-- User info at bottom -->
        <div style="padding:1rem 1.4rem; border-top:1px solid rgba(255,255,255,.05);">
            <div class="user-pill">
                <div class="user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                <div>
                    <div style="font-size:.82rem; font-weight:600;">{{ Auth::user()->name }}</div>
                    <div style="font-size:.72rem; color:var(--eco-muted);">{{ ucfirst(Auth::user()->role) }}</div>
                </div>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <div class="top-bar">
            <div class="top-bar-title">@yield('title', 'Dashboard')</div>
            <div style="display:flex;align-items:center;gap:1rem;">
                <span style="color:var(--eco-muted); font-size:.82rem;">
                    <i class="bi bi-star-fill" style="color:#fbbf24;"></i>
                    {{ number_format(Auth::user()->eco_score, 0) }} pts
                </span>
                <a href="{{ route('trips.create') }}" class="btn-eco btn" style="font-size:.82rem; padding:.4rem 1rem;">
                    <i class="bi bi-plus-lg"></i> Log Trip
                </a>
            </div>
        </div>

        @if(session('success'))
        <div class="alert alert-eco mb-3"><i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}</div>
        @endif
        @if(session('error'))
        <div class="alert alert-danger-eco mb-3"><i class="bi bi-x-circle-fill me-2"></i>{{ session('error') }}</div>
        @endif
        @if(session('warning'))
        <div class="alert alert-warning-eco mb-3"><i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('warning') }}</div>
        @endif

        @yield('content')
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>

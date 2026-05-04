<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Eco Drive') }} — Drive Greener</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background: #0f172a; color: #f8fafc; }
        .hero-section { min-height: 100vh; display: flex; flex-direction: column; }
        .navbar { padding: 1.5rem 5%; background: transparent; }
        .brand { font-size: 1.8rem; font-weight: 800; color: #22c55e; text-decoration: none; }
        .hero-content { flex: 1; display: flex; align-items: center; justify-content: center; text-align: center; padding: 2rem 5%; }
        h1 { font-size: 4.5rem; font-weight: 800; margin-bottom: 1.5rem; background: linear-gradient(135deg, #22c55e, #16a34a); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        p.lead { font-size: 1.4rem; color: #cbd5e1; max-width: 700px; margin: 0 auto 2.5rem; }
        .btn-eco { background: #22c55e; color: #000; font-weight: 700; font-size: 1.1rem; padding: 1rem 2.5rem; border-radius: 50px; text-decoration: none; transition: transform .2s, box-shadow .2s; }
        .btn-eco:hover { transform: translateY(-3px); box-shadow: 0 10px 25px rgba(34,197,94,.4); color: #000; }
        .btn-eco-outline { background: transparent; border: 2px solid #22c55e; color: #22c55e; font-weight: 700; font-size: 1.1rem; padding: 0.9rem 2.5rem; border-radius: 50px; text-decoration: none; transition: background .2s, color .2s; }
        .btn-eco-outline:hover { background: rgba(34,197,94,.1); color: #22c55e; }
        
        .features { padding: 5rem 5%; background: #1e293b; }
        .feature-icon { font-size: 2.5rem; color: #22c55e; margin-bottom: 1.5rem; background: rgba(34,197,94,.1); width: 80px; height: 80px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; }
        .feature-card { padding: 2rem; border-radius: 16px; background: rgba(255,255,255,.02); border: 1px solid rgba(255,255,255,.05); text-align: center; height: 100%; transition: transform .2s; }
        .feature-card:hover { transform: translateY(-10px); background: rgba(255,255,255,.04); }
        .feature-title { font-size: 1.5rem; font-weight: 700; margin-bottom: 1rem; }
    </style>
</head>
<body>
    <div class="hero-section">
        <nav class="navbar w-100 d-flex justify-content-between align-items-center">
            <a href="/" class="brand"><i class="bi bi-leaf-fill me-2"></i>Eco Drive</a>
            <div class="d-flex gap-3">
                @auth
                    <a href="{{ route('dashboard') }}" class="btn-eco">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn-eco-outline">Login</a>
                    <a href="{{ route('register') }}" class="btn-eco">Register</a>
                @endauth
            </div>
        </nav>
        
        <div class="hero-content">
            <div>
                <h1>Drive Smart.<br>Drive Green.</h1>
                <p class="lead">Track your trips, calculate your carbon footprint, and earn eco-points by adopting sustainable driving habits.</p>
                <div class="d-flex justify-content-center gap-3">
                    @auth
                        <a href="{{ route('trips.create') }}" class="btn-eco">Log a Trip</a>
                    @else
                        <a href="{{ route('register') }}" class="btn-eco"><i class="bi bi-rocket-takeoff-fill me-2"></i>Get Started Free</a>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <div class="features">
        <div class="container">
            <div class="text-center mb-5">
                <h2 style="font-weight: 800; font-size: 2.5rem;">Why use Eco Drive?</h2>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon"><i class="bi bi-cloud-arrow-down-fill"></i></div>
                        <h3 class="feature-title">Emission Tracking</h3>
                        <p style="color: #94a3b8;">Accurately measure your CO₂ emissions based on your specific vehicle and fuel type for every trip you make.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon"><i class="bi bi-star-fill" style="color: #fbbf24;"></i></div>
                        <h3 class="feature-title">Earn Eco Points</h3>
                        <p style="color: #94a3b8;">The more efficiently you drive, the more points you earn. Let's make sustainability rewarding.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon"><i class="bi bi-trophy-fill" style="color: #60a5fa;"></i></div>
                        <h3 class="feature-title">Global Leaderboard</h3>
                        <p style="color: #94a3b8;">Compare your eco-score with drivers globally and inspire others to adopt greener driving habits.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="text-center py-4" style="background: #0f172a; border-top: 1px solid rgba(255,255,255,.05);">
        <p style="color: #64748b; margin: 0;">&copy; {{ date('Y') }} Eco Drive. Promoting sustainable mobility.</p>
    </footer>
</body>
</html>

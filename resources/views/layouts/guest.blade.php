<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Eco Drive') }} — @yield('title', 'Welcome')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased" style="background:#0A0F1E; min-height:100vh;">

    <div class="min-h-screen flex flex-col items-center justify-center p-4"
         style="background: radial-gradient(ellipse at top, rgba(0,255,135,0.06) 0%, transparent 50%), #0A0F1E;">

        <!-- Logo -->
        <a href="/" class="flex items-center gap-3 mb-8">
            <div class="w-10 h-10 rounded-xl flex items-center justify-center"
                 style="background: linear-gradient(135deg,#00FF87,#00C9A7);">
                <svg class="w-6 h-6 text-[#0A0F1E]" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2a10 10 0 100 20A10 10 0 0012 2zm0 3a7 7 0 110 14A7 7 0 0112 5zm-1 3v5l4 2.5-.75-1.3L13 13V8h-2z"/>
                </svg>
            </div>
            <span class="font-black text-2xl text-white tracking-tight">
                Eco<span style="color:#00FF87;">Drive</span>
            </span>
        </a>

        <!-- Card -->
        <div class="w-full max-w-md glass-card p-8">
            {{ $slot }}
        </div>

        <p class="mt-8 text-xs text-slate-700">
            © {{ date('Y') }} EcoDrive. Drive Smart. Save the Planet.
        </p>
    </div>
</body>
</html>

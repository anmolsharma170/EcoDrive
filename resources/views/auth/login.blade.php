<x-guest-layout>
    <div class="mb-8 text-center">
        <h1 class="text-2xl font-black text-white mb-2">Welcome back</h1>
        <p class="text-slate-400 text-sm">Sign in to track your carbon footprint.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4 text-sm text-green-400" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-semibold text-slate-300 mb-2">
                Email Address
            </label>
            <input id="email" type="email" name="email"
                   value="{{ old('email') }}"
                   required autofocus autocomplete="username"
                   class="eco-input @error('email') !border-red-500 @enderror"
                   placeholder="you@example.com">
            @error('email')
                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-semibold text-slate-300 mb-2">
                Password
            </label>
            <input id="password" type="password" name="password"
                   required autocomplete="current-password"
                   class="eco-input @error('password') !border-red-500 @enderror"
                   placeholder="••••••••">
            @error('password')
                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Remember + Forgot -->
        <div class="flex items-center justify-between">
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="remember"
                       class="w-4 h-4 rounded" style="accent-color:#00FF87;">
                <span class="text-sm text-slate-400">Remember me</span>
            </label>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}"
                   class="text-sm font-medium transition-colors hover:text-white"
                   style="color:#00FF87;">
                    Forgot password?
                </a>
            @endif
        </div>

        <!-- Submit -->
        <button type="submit" class="btn-primary w-full justify-center py-3 text-base">
            Sign In →
        </button>

        <!-- Register Link -->
        @if (Route::has('register'))
        <p class="text-center text-sm text-slate-500">
            New to Eco Drive?
            <a href="{{ route('register') }}" class="font-semibold hover:text-white transition-colors" style="color:#00FF87;">
                Create free account
            </a>
        </p>
        @endif
    </form>
</x-guest-layout>

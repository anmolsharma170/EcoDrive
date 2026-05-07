<x-guest-layout>
    <div class="mb-8 text-center">
        <h1 class="text-2xl font-black text-white mb-2">Join Eco Drive 🌱</h1>
        <p class="text-slate-400 text-sm">Start tracking your carbon footprint today. Free forever.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block text-sm font-semibold text-slate-300 mb-2">Full Name</label>
            <input id="name" type="text" name="name"
                   value="{{ old('name') }}" required autofocus autocomplete="name"
                   class="eco-input @error('name') !border-red-500 @enderror"
                   placeholder="Your name">
            @error('name')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-semibold text-slate-300 mb-2">Email Address</label>
            <input id="email" type="email" name="email"
                   value="{{ old('email') }}" required autocomplete="username"
                   class="eco-input @error('email') !border-red-500 @enderror"
                   placeholder="you@example.com">
            @error('email')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-semibold text-slate-300 mb-2">Password</label>
            <input id="password" type="password" name="password"
                   required autocomplete="new-password"
                   class="eco-input @error('password') !border-red-500 @enderror"
                   placeholder="Min. 8 characters">
            @error('password')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-sm font-semibold text-slate-300 mb-2">Confirm Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation"
                   required autocomplete="new-password"
                   class="eco-input @error('password_confirmation') !border-red-500 @enderror"
                   placeholder="Repeat your password">
            @error('password_confirmation')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        <!-- Submit -->
        <button type="submit" class="btn-primary w-full justify-center py-3 text-base">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
            Create Free Account
        </button>

        <!-- Login Link -->
        <p class="text-center text-sm text-slate-500">
            Already have an account?
            <a href="{{ route('login') }}" class="font-semibold hover:text-white transition-colors" style="color:#00FF87;">
                Sign in
            </a>
        </p>
    </form>
</x-guest-layout>

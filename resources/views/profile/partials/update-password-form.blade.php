<section>
    <header>
        <h2 class="text-lg font-bold text-white">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-slate-400">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password" class="block text-sm font-semibold text-slate-300 mb-2">Current Password</label>
            <input id="update_password_current_password" name="current_password" type="password" class="eco-input @error('current_password', 'updatePassword') !border-red-500 @enderror" autocomplete="current-password" />
            @error('current_password', 'updatePassword')
                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="update_password_password" class="block text-sm font-semibold text-slate-300 mb-2">New Password</label>
            <input id="update_password_password" name="password" type="password" class="eco-input @error('password', 'updatePassword') !border-red-500 @enderror" autocomplete="new-password" />
            @error('password', 'updatePassword')
                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="update_password_password_confirmation" class="block text-sm font-semibold text-slate-300 mb-2">Confirm Password</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="eco-input @error('password_confirmation', 'updatePassword') !border-red-500 @enderror" autocomplete="new-password" />
            @error('password_confirmation', 'updatePassword')
                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="btn-primary py-2 px-6">{{ __('Save') }}</button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-[#00FF87]"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>

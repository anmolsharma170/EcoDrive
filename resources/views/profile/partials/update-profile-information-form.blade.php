<section>
    <header>
        <h2 class="text-lg font-bold text-white">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-slate-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <label for="name" class="block text-sm font-semibold text-slate-300 mb-2">Name</label>
            <input id="name" name="name" type="text" class="eco-input @error('name') !border-red-500 @enderror" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
            @error('name')
                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="block text-sm font-semibold text-slate-300 mb-2">Email</label>
            <input id="email" name="email" type="email" class="eco-input @error('email') !border-red-500 @enderror" value="{{ old('email', $user->email) }}" required autocomplete="username" />
            @error('email')
                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-slate-400">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-slate-300 hover:text-white rounded-md focus:outline-none transition-colors">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-[#00FF87]">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="btn-primary py-2 px-6">{{ __('Save') }}</button>

            @if (session('status') === 'profile-updated')
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

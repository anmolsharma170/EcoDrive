<section class="space-y-6">
    <header>
        <h2 class="text-lg font-bold text-white">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-1 text-sm text-slate-400">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="inline-flex items-center gap-2 px-6 py-3 rounded-xl font-semibold text-sm transition-all duration-300 bg-red-500/10 text-red-500 border border-red-500/20 hover:bg-red-500/20"
    >
        {{ __('Delete Account') }}
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6 bg-[#0F1629]">
            @csrf
            @method('delete')

            <h2 class="text-lg font-bold text-white">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="mt-1 text-sm text-slate-400">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="mt-6">
                <label for="password" class="sr-only">{{ __('Password') }}</label>
                <input
                    id="password"
                    name="password"
                    type="password"
                    class="eco-input w-full @error('password', 'userDeletion') !border-red-500 @enderror"
                    placeholder="{{ __('Password') }}"
                />
                @error('password', 'userDeletion')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <button type="button" x-on:click="$dispatch('close')" class="btn-ghost py-2 px-6">
                    {{ __('Cancel') }}
                </button>

                <button type="submit" class="inline-flex items-center gap-2 px-6 py-2 rounded-xl font-semibold text-sm transition-all duration-300 bg-red-500 text-white hover:bg-red-600">
                    {{ __('Delete Account') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>

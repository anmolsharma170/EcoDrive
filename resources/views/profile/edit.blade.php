<x-app-layout>
@section('title', 'Profile')

<div class="space-y-6 page-enter max-w-4xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <div class="text-xs font-bold uppercase tracking-widest mb-2" style="color:#00FF87;">Settings</div>
        <h1 class="text-3xl font-black text-white">Profile</h1>
        <p class="text-slate-400 mt-2">Manage your account settings and password.</p>
    </div>

    <!-- Forms -->
    <div class="space-y-6">
        <div class="glass-card p-6 sm:p-8">
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="glass-card p-6 sm:p-8">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="glass-card p-6 sm:p-8 border-red-500/20">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</div>
</x-app-layout>

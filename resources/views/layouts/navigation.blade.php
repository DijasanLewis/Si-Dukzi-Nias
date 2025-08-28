<div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
        {{ __('Dashboard') }}
    </x-nav-link>
    <x-nav-link :href="route('home')" :active="request()->routeIs('monitoring')">
        {{ __('Monitoring Petugas') }}
    </x-nav-link>
    {{-- Tampilkan tautan ini HANYA jika user adalah admin --}}
    @if(auth()->user() && auth()->user()->is_admin)
        <x-nav-link :href="url('/admin')" :active="request()->is('admin*')">
            {{ __('Admin') }}
        </x-nav-link>
    @endif
</div>
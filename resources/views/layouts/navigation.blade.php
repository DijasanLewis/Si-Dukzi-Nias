<div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
        {{ __('Dashboard') }}
    </x-nav-link>
    <x-nav-link :href="route('home')" :active="request()->routeIs('monitoring')">
        {{ __('Monitoring Petugas') }}
    </x-nav-link>
    <x-nav-link :href="route('admin.index')" :active="request()->routeIs('admin.index')">
        {{ __('Admin') }}
    </x-nav-link>
</div>
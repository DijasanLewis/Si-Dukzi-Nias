<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SIDATA ZI') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <link rel="icon" href="{{ asset('images/logo_bps.png') }}" type="image/png">
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <link rel="stylesheet" href="{{ asset('css/filament/filament/app.css') }}" />
        <script src="{{ asset('js/filament/filament/app.js') }}" defer></script>
        @filamentStyles
    </head>
    <body class="font-sans antialiased" x-data="{ loading: true }"
        x-init="
            const livewireReady = new Promise(resolve => {
                window.addEventListener('livewire:initialized', () => resolve());
            });

            const minimumTimePassed = new Promise(resolve => {
                setTimeout(() => resolve(), 1000); // Tunggu minimal 1000ms (1 detik)
            });

            Promise.all([livewireReady, minimumTimePassed]).then(() => {
                loading = false;
            });
        "
    >
        <div
            x-show="loading"
            x-transition:leave.duration.500ms
            class="fixed inset-0 z-[999] flex items-center justify-center bg-gray-900/90 text-white"
        >
            <div class="flex flex-col items-center">
                <img src="{{ asset('images/SIDATA-ZI.png') }}" alt="Logo" class="w-100 animate-pulse">
                <p class="mt-4 text-xl">Loading...</p>
            </div>
        </div>
        <div class="min-h-screen flex flex-col bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <main class="flex-grow">
                {{ $slot }}
            </main>

            @include('layouts.footer')
        </div>

        @livewireScripts
        @livewire('notifications')
        @stack('scripts')
    </body>
</html>
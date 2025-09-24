<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SIDATA ZI') }} - Monitoring</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <link rel="icon" href="{{ asset('images/SIDATA-ZI.png') }}" type="image/png">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col bg-gray-50 dark:bg-gray-900">
            <nav class="bg-white dark:bg-gray-800 shadow-md sticky top-0 z-50">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between items-center h-16">
                        <div class="flex items-center space-x-4">
                            <a href="{{ route('home') }}" class="flex-shrink-0">
                                <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                            </a>
                            <h1 class="text-lg font-semibold text-gray-700 dark:text-gray-300 hidden sm:block">
                                SIDATA ZI BPS Kabupaten Nias
                            </h1>
                        </div>

                        <div>
                            <a href="{{ route('login') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition ease-in-out duration-150">
                                Login
                            </a>
                        </div>
                    </div>
                </div>
            </nav>

            <main class="flex-grow">
                {{ $slot }}
            </main>

            @include('layouts.footer')
        </div>
        @livewireScripts
    </body>
</html>
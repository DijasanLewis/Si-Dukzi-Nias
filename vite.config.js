import { defineConfig } from 'vite';
import laravel, { refreshPaths } from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            // TAMBAHKAN 'resources/css/filament/admin/theme.css' DI DALAM ARRAY INI
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/images/LogoBPS2Asset 3.png',
            ],
            refresh: [
                ...refreshPaths,
                'app/Livewire/**',
                'app/Filament/**',
            ],
        }),
    ],
});
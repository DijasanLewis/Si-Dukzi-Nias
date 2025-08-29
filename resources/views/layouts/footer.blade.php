{{-- views/layouts/footer.blade.php --}}
<footer class="bg-white dark:bg-gray-800 border-t border-gray-100 dark:border-gray-700 mt-auto">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row justify-between items-center text-sm text-gray-500 dark:text-gray-400">
            <div class="text-center md:text-left mb-4 md:mb-0">
                <p class="font-semibold">SI-DUKZI v2.0</p>
                <p>&copy; {{ date('Y') }} BPS Kabupaten Nias. All Rights Reserved.</p>
            </div>
            <div class="flex items-center space-x-4">
                <a href="https://nias.bps.go.id" target="_blank" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition">
                    Website BPS Nias
                </a>
                <span>|</span>
                <a href="{{ route('home') }}" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition">
                    Papan Monitoring
                </a>
            </div>
        </div>
    </div>
</footer>
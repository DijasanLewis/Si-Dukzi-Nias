{{-- views/layouts/footer.blade.php --}}
<footer class="bg-white dark:bg-gray-800 border-t border-gray-100 dark:border-gray-700 mt-auto">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row justify-between items-center text-sm text-gray-500 dark:text-gray-400">
            <div class="text-center md:text-left mb-4 md:mb-0">
                <p class="font-semibold">SIDATA ZI BPS NIAS v1.0</p>
                <p>&copy; {{ date('Y') }} BPS Kabupaten Nias. All Rights Reserved.</p>
                <p class="mt-1">Developed by: Yedija Lewi Suryadi</p>
            </div>
            <div class="grid grid-cols-2 gap-2">
                <a href="https://niaskab.bps.go.id/" target="_blank" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition">
                    Website BPS Kabupaten Nias
                </a>
                <a href="{{ route('home') }}" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition">
                    Halaman Monitoring Petugas
                </a>
                <a href="https://sites.google.com/view/bps1201/zona-integritas/rencana-kinerja-zi" target="_blank" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition">
                    SIGA
                </a>
                <a href="https://docs.google.com/spreadsheets/d/1Adk7V5fZgojxAJGkODQvUyxXgSmbIJzrDJ-VlUzpKQk/edit?usp=sharing" target="_blank" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition">
                    Rencana Kerja ZI 2025
                </a>
            </div>
        </div>
    </div>
</footer>
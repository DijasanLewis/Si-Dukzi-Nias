<x-app-layout>
    {{-- Bagian Header Halaman --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Pemenuhan Bukti Dukung ZI') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-8 text-gray-900">
                    
                    {{-- Judul dan Tombol Aksi --}}
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 pb-6 border-b border-gray-200">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-800">Daftar Checklist Zona Integritas</h3>
                            <p class="text-base text-gray-500 mt-1">BPS Kabupaten Nias</p>
                        </div>
                        <a href="{{ route('zi.sync') }}" class="mt-4 sm:mt-0 flex items-center space-x-2 bg-blue-600 hover:bg-blue-700 text-white font-bold px-5 py-2.5 rounded-lg transition duration-300 text-base shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a5.002 5.002 0 008.057 2.332 1 1 0 11.886 1.786A7.002 7.002 0 014.999 17v-2.101a1 1 0 011.885-.666 1 1 0 01.115.033z" clip-rule="evenodd" /></svg>
                            <span>Sinkronkan Status</span>
                        </a>
                    </div>

                    {{-- Notifikasi Sukses --}}
                    @if (session('success'))
                        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="bg-green-100 border-l-4 border-green-500 text-green-800 p-4 mb-5 rounded-r-lg" role="alert">
                            <p class="font-medium">{{ session('success') }}</p>
                        </div>
                    @endif

                    {{-- STRUKTUR AKORDEON UTAMA --}}
                    <div class="space-y-4">
                        @forelse ($checklists as $aspek => $areas)
                        {{-- Level 1: ASPEK --}}
                        <div x-data="{ open: true }" class="border border-gray-300 rounded-xl shadow-sm transition-shadow hover:shadow-md">
                            <div @click="open = !open" class="w-full flex justify-between items-center p-4 cursor-pointer bg-gray-100 rounded-t-xl hover:bg-gray-200">
                                <span class="text-xl font-bold text-gray-800 tracking-wide">{{ $aspek }}</span>
                                <svg class="w-6 h-6 transform transition-transform text-gray-600" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                            <div x-show="open" x-transition class="p-4 border-t border-gray-300 space-y-3 bg-white rounded-b-xl">
                                @foreach ($areas as $area => $pilars)
                                {{-- Level 2: AREA --}}
                                <div x-data="{ open: true }" class="bg-white border border-blue-300 rounded-lg">
                                    <div @click="open = !open" class="w-full flex justify-between items-center p-3 cursor-pointer bg-blue-50 hover:bg-blue-100">
                                        <span class="text-lg font-semibold text-blue-900">{{ $area }}</span>
                                        <svg class="w-5 h-5 transform transition-transform text-blue-500" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                    </div>
                                    <div x-show="open" x-transition class="px-4 py-2 border-t border-blue-200 space-y-3">
                                        @foreach ($pilars as $pilar => $subpilars)
                                        {{-- Level 3: PILAR --}}
                                        <div x-data="{ open: false }" class="border-t border-gray-200 pt-2">
                                            <div @click="open = !open" class="w-full flex justify-between items-center py-2 cursor-pointer hover:bg-gray-50 rounded-md px-2">
                                                <span class="font-medium text-gray-800 text-base">{{ $pilar }}</span>
                                                <svg class="w-5 h-5 transform transition-transform text-gray-500" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                            </div>
                                            <div x-show="open" x-transition class="pl-4 pt-2 mt-1 border-l-2 border-blue-300 space-y-2">
                                                 @foreach ($subpilars as $subpilar => $pertanyaans)
                                                 {{-- Level 4: SUBPILAR --}}
                                                 <div x-data="{ open: false }">
                                                    <div @click="open = !open" class="w-full flex justify-between items-center py-2 cursor-pointer hover:bg-gray-50 rounded-md px-2">
                                                        <span class="italic text-gray-600 text-base">{{ $subpilar }}</span>
                                                        <svg class="w-5 h-5 transform transition-transform text-gray-500" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                                    </div>
                                                    {{-- Level 5: PERTANYAAN (Tabel) --}}
                                                    <div x-show="open" x-transition class="pl-4">
                                                        @foreach ($pertanyaans as $item)
                                                        <div class="flex items-center justify-between border-t border-gray-200 py-3">
                                                            <p class="text-gray-800 flex-1 pr-4 text-base">{{ $item->pertanyaan }}</p>
                                                            <div class="flex items-center space-x-2 flex-shrink-0">
                                                                <span class="w-20 text-center text-sm font-semibold rounded-full px-3 py-1 {{ $item->status == 'Terisi' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                                    {{ $item->status }}
                                                                </span>
                                                                @if($item->google_drive_folder_id)
                                                                <input type="text" id="link-{{ $item->id }}" value="https://drive.google.com/drive/folders/{{ $item->google_drive_folder_id }}" class="sr-only">
                                                                <button onclick="copyLink({{ $item->id }})" class="bg-gray-200 hover:bg-gray-300 text-gray-700 p-2 rounded-lg transition duration-300" title="Salin Tautan">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" /></svg>
                                                                </button>
                                                                <a href="https://drive.google.com/drive/folders/{{ $item->google_drive_folder_id }}" target="_blank" class="bg-blue-500 hover:bg-blue-600 text-white p-2 rounded-lg transition duration-300" title="Buka Folder">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg>
                                                                </a>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                 </div>
                                                 @endforeach
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-16 px-6 border-2 border-dashed border-gray-300 rounded-lg">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                            </svg>
                            <h3 class="mt-2 text-lg font-medium text-gray-900">Data Checklist Kosong</h3>
                            <p class="mt-1 text-base text-gray-500">
                                Belum ada data checklist ZI yang tersedia di database.
                            </p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function copyLink(id) {
            const linkInput = document.getElementById('link-' + id);
            navigator.clipboard.writeText(linkInput.value).then(() => {
                alert('Tautan berhasil disalin!');
            });
        }
    </script>
</x-app-layout>
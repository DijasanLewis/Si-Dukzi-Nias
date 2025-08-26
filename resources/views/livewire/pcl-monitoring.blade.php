<div class="bg-gray-100 min-h-screen">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12">

        {{-- HEADER --}}
        <header class="mb-8">
            <h1 class="text-3xl sm:text-4xl font-bold text-gray-800 tracking-tight">Papan Pemantauan Progress PCL</h1>
            <p class="mt-2 text-lg text-gray-600">Zona Integritas BPS Kabupaten Nias</p>
        </header>

        {{-- GRID STATISTIK KESELURUHAN UNTUK DESKTOP --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="md:col-span-2 bg-white rounded-xl shadow-lg p-6 border border-gray-200">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Progress Keseluruhan</h2>
                <div class="w-full bg-gray-200 rounded-full h-6">
                    <div class="bg-blue-600 h-6 rounded-full text-white text-sm flex items-center justify-center font-bold" style="width: {{ $overallStats->persentase }}%;">
                        {{ $overallStats->persentase }}%
                    </div>
                </div>
                <div class="mt-4 flex justify-between items-center text-sm text-gray-500">
                    <span>
                        <span class="font-bold text-gray-700">{{ $overallStats->tugas_selesai }}</span> dari 
                        <span class="font-bold text-gray-700">{{ $overallStats->total_tugas }}</span> tugas selesai
                    </span>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-200">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Ringkasan</h2>
                <div class="space-y-3">
                    <div class="flex justify-between items-baseline">
                        <span class="text-gray-500">Jumlah PCL Aktif:</span>
                        <span class="font-bold text-2xl text-gray-800">{{ $statistikPetugas->count() }}</span>
                    </div>
                    <div class="flex justify-between items-baseline">
                        <span class="text-gray-500">Data Diperbarui:</span>
                        @if($overallStats->last_sync)
                            <span class="font-semibold text-gray-800 text-right">{{ \Carbon\Carbon::parse($overallStats->last_sync)->locale('id')->diffForHumans() }}</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- INPUT PENCARIAN --}}
        <div class="mb-6">
            <input 
                type="text" 
                wire:model.live.debounce.300ms="search"
                placeholder="Cari nama petugas..."
                class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 transition"
            >
        </div>

        {{-- TABEL MONITORING PCL --}}
        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-1/3">
                            Nama Petugas (PCL)
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Progress Penyelesaian
                        </th>
                        <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">Expand</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($statistikPetugas->sortBy('nama') as $petugas)
                        {{-- Baris Utama Petugas --}}
                        <tr 
                            class="hover:bg-gray-50 cursor-pointer" 
                            wire:click="toggleDetails({{ $petugas->id }})"
                            wire:key="petugas-{{ $petugas->id }}">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-semibold text-gray-900">{{ $petugas->nama }}</div>
                                <div class="text-xs text-gray-500">{{ $petugas->total_tugas }} Tugas</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-full bg-gray-200 rounded-full h-5 mr-3">
                                        <div class="bg-green-500 h-5 rounded-full" style="width: {{ $petugas->persentase }}%;"></div>
                                    </div>
                                    <span class="text-sm font-medium text-gray-700">{{ $petugas->persentase }}%</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                {{-- IKON CHEVRON INTERAKTIF --}}
                                <svg class="w-5 h-5 text-gray-400 transform transition-transform duration-200" 
                                    :class="{ 'rotate-90': {{ $expandedPetugasId === $petugas->id ? 'true' : 'false' }} }">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </td>
                        </tr>

                        {{-- Baris Detail Tugas (Collapsible) --}}
                        @if ($expandedPetugasId === $petugas->id)
                            <tr wire:key="details-{{ $petugas->id }}">
                                <td colspan="3" class="p-0">
                                    <div class="p-4 bg-gray-50 border-t border-b border-gray-200">
                                        <h4 class="font-semibold text-sm text-gray-800 mb-3">Rincian Tugas untuk {{ $petugas->nama }}:</h4>
                                        <ul class="space-y-2">
                                            @foreach($petugas->tasks as $task)
                                                <li class="p-3 bg-white rounded-md border border-gray-200 flex justify-between items-center">
                                                    <div>
                                                        <p class="text-sm text-gray-800">{{ $task->pertanyaan }}</p>
                                                        <p class="text-xs text-gray-500 mt-1">
                                                            {{ $task->aspek }} > {{ $task->area }} > {{ $task->pilar }}
                                                        </p>
                                                    </div>
                                                    <span class="text-xs font-bold py-1 px-3 rounded-full {{ $task->status == 'Terisi' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                        {{ $task->status }}
                                                    </span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-12 text-center text-sm text-gray-500">
                                Belum ada petugas yang ditugaskan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <footer class="text-center mt-8 text-sm text-gray-500">
            <p>&copy; {{ date('Y') }} BPS Kabupaten Nias. All rights reserved.</p>
        </footer>

    </div>
</div>
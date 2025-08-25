<div class="bg-gray-100 min-h-screen py-8 sm:py-12">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">

        {{-- HEADER --}}
        <header class="text-center mb-8">
            <h1 class="text-3xl sm:text-4xl font-bold text-gray-800 tracking-tight">Papan Pemantauan Progress PCL</h1>
            <p class="mt-2 text-lg text-gray-600">Zona Integritas BPS Kabupaten Nias</p>
        </header>

        {{-- KARTU STATISTIK KESELURUHAN --}}
        <div class="bg-white rounded-xl shadow-lg p-6 mb-8 border border-gray-200">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Progress Keseluruhan</h2>
            <div class="flex items-center">
                <div class="w-full bg-gray-200 rounded-full h-6">
                    <div class="bg-blue-600 h-6 rounded-full text-white text-sm flex items-center justify-center font-bold" style="width: {{ $overallStats->persentase }}%;">
                        {{ $overallStats->persentase }}%
                    </div>
                </div>
            </div>
            <div class="mt-4 flex justify-between items-center text-sm text-gray-500">
                <span>
                    <span class="font-bold text-gray-700">{{ $overallStats->tugas_selesai }}</span> dari 
                    <span class="font-bold text-gray-700">{{ $overallStats->total_tugas }}</span> tugas selesai
                </span>
                @if($overallStats->last_sync)
                    <span>
                        Data diperbarui: {{ \Carbon\Carbon::parse($overallStats->last_sync)->locale('id')->diffForHumans() }}
                    </span>
                @endif
            </div>
        </div>

        {{-- TABEL MONITORING PCL --}}
        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Nama Petugas (PCL)
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Progress Penyelesaian
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
                        </tr>
                        
                        {{-- Baris Detail Tugas (Collapsible) --}}
                        @if ($expandedPetugasId === $petugas->id)
                            <tr wire:key="details-{{ $petugas->id }}">
                                <td colspan="2" class="p-0">
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
                            <td colspan="2" class="px-6 py-12 text-center text-sm text-gray-500">
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
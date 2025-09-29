<div class="bg-gray-100 min-h-screen">
    <div class="container mx-auto px-2 sm:px-6 lg:px-8 py-6 sm:py-10">

        {{-- HEADER DAN KONTROL --}}
        <div class="p-4 bg-white rounded-lg shadow-sm border mb-5">
            {{-- Bagian Atas: Judul dan Filter Tahun --}}
            <div class="flex flex-col sm:flex-row justify-between items-center gap-4 text-center sm:text-left">
                <div>
                    <h1 class="text-xl sm:text-2xl font-bold text-gray-800">Perencanaan Target Tahunan</h1>
                    <p class="text-sm text-gray-600">Atur target untuk semua pertanyaan secara massal.</p>
                </div>
                <div class="flex items-center gap-2">
                    <label for="tahun" class="font-semibold text-gray-700">Tahun:</label>
                    <select wire:model.live="selectedYear" id="tahun" class="form-select rounded-md shadow-sm border-gray-300 text-gray-900">
                        @foreach($years as $year)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <hr class="my-3">
            {{-- NAVIGASI BULAN --}}
            <div class="flex justify-center items-center">
                <select wire:model.live="selectedMonth" 
                        id="bulan" 
                        class="form-select rounded-md shadow-sm border-gray-300 text-gray-900 font-bold text-lg sm:text-xl text-indigo-600 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    @for ($i = 1; $i <= 12; $i++)
                        <option value="{{ $i }}">
                            {{ \Carbon\Carbon::create()->month($i)->translatedFormat('F') }}
                        </option>
                    @endfor
                </select>
            </div>
        </div>

        {{-- TABEL GRID --}}
        <div class="bg-white rounded-xl shadow-md overflow-x-auto border border-gray-200">
            <table class="min-w-full" wire:loading.class.delay="opacity-50">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-full sm:w-8/12">Pertanyaan</th>
                        @for ($m = 1; $m <= 4; $m++)
                            <th class="hidden sm:table-cell px-2 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-1/12">M{{$m}}</th>
                        @endfor
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($pertanyaanGrouped as $aspek => $areas)
                        {{-- Level 1: ASPEK --}}
                        <tr class="bg-indigo-100">
                            <td colspan="5" class="px-2 py-2 font-extrabold text-indigo-800 text-sm tracking-wide">{{ $aspek }}</td>
                        </tr>
                        @foreach ($areas as $area => $pilars)
                            {{-- Level 2: AREA --}}
                            <tr class="bg-blue-50">
                                <td colspan="5" class="px-4 py-2 font-bold text-blue-700 text-sm">{{ $area }}</td>
                            </tr>
                            @foreach ($pilars as $pilar => $subPilars)
                                {{-- Level 3: PILAR --}}
                                <tr class="bg-gray-100">
                                    <td colspan="5" class="px-6 py-2 font-semibold text-gray-700 text-sm">{{ $pilar }}</td>
                                </tr>
                                @foreach ($subPilars as $subPilar => $pertanyaans)
                                    {{-- Level 4: SUB PILAR --}}
                                    @if($subPilar)
                                    <tr class="bg-gray-50">
                                        <td colspan="5" class="px-8 py-1.5 font-medium text-gray-600 text-sm italic">{{ $subPilar }}</td>
                                    </tr>
                                    @endif
                                    
                                    {{-- Level 5: PERTANYAAN (Logika ini tetap sama) --}}
                                    @foreach ($pertanyaans as $pertanyaan)
                                        <tr wire:key="pertanyaan-{{ $pertanyaan->id }}">
                                            <td class="px-4 sm:px-10 py-3 text-sm text-gray-800">
                                                <p class="leading-relaxed">{{ $pertanyaan->pertanyaan }}</p>
                                                {{-- GRID TARGET UNTUK TAMPILAN MOBILE --}}
                                                <div class="sm:hidden mt-3">
                                                    <p class="font-semibold text-xs text-gray-500 mb-1 uppercase">Target Mingguan:</p>
                                                    <div class="grid grid-cols-4 gap-2">
                                                        @for ($minggu = 1; $minggu <= 4; $minggu++)
                                                            @php
                                                                $status = $dirtyTargets[$pertanyaan->id][$minggu] ?? $originalTargets[$pertanyaan->id][$minggu] ?? null;
                                                                $colorClass = match($status) {
                                                                    0 => 'bg-yellow-300', 1 => 'bg-green-400', default => 'bg-white border border-gray-300',
                                                                };
                                                            @endphp
                                                            <button wire:click="updateTarget({{ $pertanyaan->id }}, {{ $minggu }})" class="w-full h-8 rounded-md flex items-center justify-center font-bold text-gray-600 text-sm {{ $colorClass }}">
                                                                M{{ $minggu }}
                                                            </button>
                                                        @endfor
                                                    </div>
                                                </div>
                                            </td>
                                            {{-- TOMBOL TARGET UNTUK TAMPILAN DESKTOP --}}
                                            @for ($minggu = 1; $minggu <= 4; $minggu++)
                                                <td class="hidden sm:table-cell text-center">
                                                    @php
                                                        $status = $dirtyTargets[$pertanyaan->id][$minggu] ?? $originalTargets[$pertanyaan->id][$minggu] ?? null;
                                                        $colorClass = match($status) {
                                                            0 => 'bg-yellow-300 hover:bg-yellow-400',
                                                            1 => 'bg-green-400 hover:bg-green-500',
                                                            default => 'bg-white hover:bg-gray-200 border border-gray-300',
                                                        };
                                                    @endphp
                                                    <button wire:click="updateTarget({{ $pertanyaan->id }}, {{ $minggu }})" 
                                                        class="w-8 h-8 rounded-md mx-auto transition-colors {{ $colorClass }}" 
                                                        title="Status: {{ is_null($status) ? 'Kosong' : ($status == 0 ? 'Ada Target' : 'Tercapai') }}">
                                                    </button>
                                                </td>
                                            @endfor
                                        </tr>
                                    @endforeach
                                @endforeach
                            @endforeach
                        @endforeach
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-12 px-4 text-gray-500">
                                <p class="font-semibold">Tidak ada data pertanyaan.</p>
                                <p class="text-sm mt-1">Pastikan data checklist sudah di-seed ke database.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- TOMBOL SIMPAN PERUBAHAN (FLOATING) --}}
        @if (!empty($dirtyTargets))
            <div class="fixed bottom-4 right-4 sm:bottom-6 sm:right-6 z-50">
                <button wire:click="saveChanges" 
                        wire:loading.attr="disabled"
                        class="flex items-center px-4 py-2 sm:px-6 sm:py-3 bg-blue-600 text-white font-bold rounded-lg shadow-lg hover:bg-blue-700 transition-all duration-200 transform hover:scale-105">
                    <svg wire:loading wire:target="saveChanges" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span class="text-sm sm:text-base">Simpan Perubahan</span>
                    <span class="ml-2 bg-white text-blue-600 text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">
                        {{ collect($dirtyTargets)->flatten()->count() }}
                    </span>
                </button>
                <button wire:click="cancelChanges"
                        wire:loading.attr="disabled"
                        class="flex items-center px-4 py-2 bg-gray-600 text-white font-semibold rounded-lg shadow-lg hover:bg-gray-700 transition-all duration-200 text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    Batal
                </button>
            </div>
        @endif
    </div>
</div>
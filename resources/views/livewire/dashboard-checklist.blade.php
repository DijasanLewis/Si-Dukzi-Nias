<div class="p-6 md:p-8 text-gray-900">
    {{-- Header Container --}}
    <div class="flex flex-col sm:flex-row justify-between items-center sm:items-start mb-6 pb-6 border-b border-gray-200 w-3/4 sm:w-full">

        {{-- Judul dan Sub-judul (Kiri di desktop, Tengah di mobile) --}}
        <div class="flex flex-col justify-between sm:justify-center sm:text-left w-full sm:w-2/3">
            <h3 class="text-2xl font-bold text-gray-800 w-full text-center sm:text-left">Pembangunan Zona Integritas</h3>
            <p class="text-gray-500 mt-1 w-full text-center sm:text-left">BPS Kabupaten Nias</p>
            
            <a href="https://docs.google.com/spreadsheets/d/1Adk7V5fZgojxAJGkODQvUyxXgSmbIJzrDJ-VlUzpKQk/edit?usp=sharing" class="flex w-full">
                <button type="button"
                    class="w-full sm:w-auto flex justify-center items-center space-x-2 bg-blue-600 hover:bg-blue-700 text-white font-bold px-5 py-2.5 rounded-lg transition duration-300 text-base shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 disabled:opacity-50 disabled:cursor-wait">
                    <span>Sheet Rencana Kerja ZI</span>
                </button>
            </a>
        </div>

        {{-- Tombol dan Keterangan (Kanan di desktop, Tengah di mobile) --}}
        <div class="w-full sm:w-1/3 flex flex-col items-center sm:items-end mt-2 sm:mt-0 gap-2">
            <button 
                type="button"
                wire:click="syncStatus"
                wire:loading.attr="disabled"
                class="w-full sm:w-auto flex justify-center sm:justify-end items-center space-x-2 bg-blue-600 hover:bg-blue-700 text-white font-bold px-5 py-2.5 rounded-lg transition duration-300 text-base shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 disabled:opacity-50 disabled:cursor-wait">
                
                <svg wire:loading wire:target="syncStatus" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            
                <span>Sinkronisasi Drive</span>
            </button>
            <div class="text-center sm:text-righ w-fullt">
                <p class="text-xs text-gray-500">
                    Sinkronisasi untuk memperbarui status dan isi folder dari Google Drive.
                </p>
                <p class="text-xs text-gray-500">
                    Misalnya saat mengupload dan menghapus file.
                </p>
            </div>
            {{-- TOMBOL EXPORT EXCEL BARU --}}
            <button 
                type="button"
                wire:click="export"
                wire:loading.attr="disabled"
                wire:loading.class="cursor-wait"
                class="w-full sm:w-auto flex justify-center items-center space-x-2 bg-green-600 hover:bg-green-700 text-white font-bold px-5 py-2.5 rounded-lg transition duration-300 text-base shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50 disabled:opacity-50">
                
                <svg wire:loading.remove wire:target="export" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 -ml-1 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                </svg>
                
                <span>Export Excel</span>
            </button>
            {{-- AKHIR TOMBOL EXPORT --}}
        </div>
    </div>

    {{-- FITUR PENCARIAN (Menggunakan Livewire) --}}
        <div class="mb-6 grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
        
        {{-- Filter 1: Pilih Petugas (Dropdown) --}}
        <div>
            <select 
                wire:model.live="selectedPetugas"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition"
            >
                <option value="">-- Semua Petugas --</option>
                @foreach($petugasList as $petugas)
                    <option value="{{ $petugas->id }}">{{ $petugas->nama }}</option>
                @endforeach
            </select>
        </div>

        {{-- Filter 2: Cari Pemeriksa (Text Input) --}}
        <div>
            <input 
                type="text" 
                wire:model.live.debounce.300ms="searchPemeriksa"
                placeholder="Cari Pemeriksa di Rencana Aksi..."
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
        </div>

        {{-- Filter 3: Pencarian Umum (yang sudah ada) --}}
        <div>
            <input 
                type="text" 
                wire:model.live.debounce.300ms="search"
                placeholder="Cari berdasarkan kata kunci..."
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
        </div>
    </div>

    {{-- STRUKTUR AKORDEON UTAMA --}}
    <div class="space-y-4 mb-36">
        {{-- PERULANGAN UNTUK ASPEK --}}
        @forelse ($checklists as $aspek => $areas)
            <div x-data="{ open: true }" class="border border-gray-300 rounded-xl shadow-sm transition-shadow hover:shadow-md">
                <div @click.stop="open = !open" class="w-full flex justify-between items-center p-4 cursor-pointer bg-gray-100 rounded-t-xl hover:bg-gray-200">
                    <span class="text-xl font-bold text-gray-800 tracking-wide">{{ $aspek }}</span>
                    <svg class="w-6 h-6 transform transition-transform text-gray-600" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </div>
                <div x-show="open" x-transition class="p-4 border-t border-gray-300 space-y-3 bg-white rounded-b-xl">
                    @foreach ($areas as $area => $pilars)
                        <div x-data="{ open: false }" class="bg-white border border-blue-300 rounded-lg">
                            <div @click.stop="open = !open" class="w-full flex justify-between items-center p-3 cursor-pointer bg-blue-50 hover:bg-blue-100">
                                <span class="text-lg font-semibold text-blue-900">{{ $area }}</span>
                                <svg class="w-5 h-5 transform transition-transform text-blue-500" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                            <div x-show="open" x-transition class="px-4 py-2 border-t border-blue-200 space-y-3">
                                @foreach ($pilars as $pilar => $sub_pilars)
                                    <div x-data="{ open: false }" class="border-t border-gray-200 pt-2">
                                        <div @click.stop="open = !open" class="w-full flex justify-between items-center py-2 cursor-pointer hover:bg-gray-50 rounded-md px-2">
                                            <span class="font-medium text-gray-800 text-base">{{ $pilar }}</span>
                                            <svg class="w-5 h-5 transform transition-transform text-gray-500" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                        </div>
                                        <div x-show="open" x-transition class="pl-4 pt-2 mt-1 border-l-2 border-blue-300 space-y-2">
                                            @foreach ($sub_pilars as $sub_pilar => $pertanyaans)
                                                <div x-data="{ open: false }">
                                                    <div @click.stop="open = !open" class="w-full flex justify-between items-center py-2 cursor-pointer hover:bg-gray-50 rounded-md px-2">
                                                        <span class="italic text-gray-600 text-base">{{ $sub_pilar }}</span>
                                                        <svg class="w-5 h-5 transform transition-transform text-gray-500" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                                    </div>
                                                    <div x-show="open" x-transition class="pl-4">
                                                        {{-- INI ADALAH PERULANGAN YANG MEMPERBAIKI ERROR --}}
                                                        @foreach ($pertanyaans as $item)
                                                            <div x-data="{ open: false }" class="border-b border-gray-200 last:border-b-0" wire:key="item-{{ $item->id }}">
                                                                
                                                                {{-- ============================ AWAL PERUBAHAN ============================ --}}
                                                                {{-- 1. Seluruh baris ini sekarang menjadi tombol pemicu akordeon --}}
                                                                <div @click="open = !open" class="flex flex-wrap flex-col sm:flex-row items-center justify-between gap-4 cursor-pointer hover:bg-gray-100 rounded-lg p-2 -m-2">
                                                                    
                                                                    {{-- Teks Pertanyaan --}}
                                                                    <p class="text-gray-800 flex-1">{{ $item->pertanyaan }}</p>
                                                                    
                                                                    {{-- Kolom Aksi Cepat (disebelah kanan) --}}
                                                                    <div class="flex items-center justify-end gap-3 flex-shrink-0 w-full sm:w-auto">
                                                                        
                                                                        {{-- Petugas --}}
                                                                        <div @click.stop class="w-40"> {{-- @click.stop agar akordeon tidak toggle saat dropdown diklik --}}
                                                                            @if(auth()->user()->is_admin)
                                                                                <select wire:model.live="assignedPetugas.{{ $item->id }}" class="block w-full text-sm border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 ease-in-out" title="Pilih Petugas">
                                                                                    <option value="">-- Assign Petugas --</option>
                                                                                    @foreach($petugasList as $petugas)
                                                                                        <option value="{{ $petugas->id }}">{{ $petugas->nama }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            @else
                                                                                @if ($item->petugas)
                                                                                    <div class="px-3 py-1.5 bg-indigo-50 border border-indigo-200 rounded-lg shadow-sm w-full"><p class="text-sm font-semibold text-indigo-800 truncate" title="{{ $item->petugas->nama }}">{{ $item->petugas->nama }}</p></div>
                                                                                @else
                                                                                    <div class="px-3 py-1.5 bg-gray-100 border border-gray-300 rounded-lg shadow-sm w-full"><p class="text-sm italic text-gray-500">Belum di-assign</p></div>
                                                                                @endif
                                                                            @endif
                                                                        </div>
                                                                        
                                                                        {{-- Status Badge (Folder) --}}
                                                                        <div class="flex-shrink-0">
                                                                            @if ($item->status == 'Terisi')
                                                                                <button @click.prevent.stop="$dispatch('open-file-modal', { files: @js($cachedFiles[$item->id] ?? []) })" class="text-xs text-center font-semibold rounded-full bg-green-100 text-green-800 hover:bg-green-200 px-2.5 py-1">Terisi</button>
                                                                            @else
                                                                                <span class="text-xs text-center font-semibold rounded-full px-2.5 py-1 bg-red-100 text-red-800">Kosong</span>
                                                                            @endif
                                                                        </div>

                                                                        {{-- Status Pemeriksa (Checkbox) --}}
                                                                        <div @click.stop class="flex-shrink-0"> {{-- @click.stop agar akordeon tidak toggle saat checkbox diklik --}}
                                                                            <label for="checker-{{ $item->id }}" class="flex items-center cursor-pointer">
                                                                                <input type="checkbox" id="checker-{{ $item->id }}" wire:model.live="statusPemeriksa.{{ $item->id }}" class="form-checkbox h-5 w-5 rounded-full cursor-pointer transition duration-150 ease-in-out" x-bind:class="{ 'text-green-600': $wire.statusPemeriksa[{{ $item->id }}], 'text-red-600': !$wire.statusPemeriksa[{{ $item->id }}] }">
                                                                                <span class="ml-2 font-medium text-xs transition-colors duration-200" x-bind:class="{ 'text-green-800 bg-green-100 rounded-full px-2 py-0.5': $wire.statusPemeriksa[{{ $item->id }}], 'text-red-800 bg-red-100 rounded-full px-2 py-0.5': !$wire.statusPemeriksa[{{ $item->id }}] }">
                                                                                    <span x-text="$wire.statusPemeriksa[{{ $item->id }}] ? 'Lengkap' : 'Belum'"></span>
                                                                                </span>
                                                                            </label>
                                                                        </div>
                                                                    </div>

                                                                    {{-- 2. Ikon panah (chevron) sekarang ada di sini --}}
                                                                    <div class="flex-shrink-0">
                                                                        <svg class="w-5 h-5 transform transition-transform text-gray-500" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                                                    </div>

                                                                </div>
                                                                {{-- ============================ AKHIR PERUBAHAN ============================ --}}

                                                                {{-- Konten Akordeon Detail --}}
                                                                <div x-show="open" x-transition class="mt-2 pl-4 pr-2 space-y-4 bg-gray-50 p-4 rounded-lg border border-gray-200">
                                                                    @if ($item->google_drive_folder_id)
                                                                        <div class="pb-2 border-b">
                                                                            <label class="block text-sm font-medium text-gray-700 mb-2">Bukti Dukung (Google Drive)</label>
                                                                            <div class="flex justify-between items-center bg-white p-2 border rounded-md">
                                                                                <span class="text-sm text-gray-600 truncate pr-2">Folder telah dibuat</span>
                                                                                <div class="flex items-center space-x-2 flex-shrink-0">
                                                                                    <button wire:click="copyLink('{{ $item->google_drive_folder_id }}')" title="Copy Link" class="p-1.5 text-gray-500 hover:bg-gray-100 rounded-full focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                                                                        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 0 1-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 0 1 1.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 0 0-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 4.625-2.25-2.25m0 0-2.25 2.25M15.75 12l2.25-2.25" /></svg>
                                                                                    </button>
                                                                                    <a href="https://drive.google.com/drive/folders/{{ $item->google_drive_folder_id }}" target="_blank" title="Buka di Tab Baru" class="p-1.5 text-gray-500 hover:bg-gray-100 rounded-full focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                                                                        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" /></svg>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                    <div>
                                                                        <label for="rencana-aksi-{{ $item->id }}" class="block text-sm font-medium text-gray-700 mb-1">Rencana Aksi</label>
                                                                        <textarea wire:model.defer="texts.{{ $item->id }}.rencana_aksi" id="rencana-aksi-{{ $item->id }}" rows="4" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition" placeholder="Tuliskan rencana aksi di sini..."></textarea>
                                                                    </div>
                                                                    <div>
                                                                        <label for="kendala-{{ $item->id }}" class="block text-sm font-medium text-gray-700 mb-1">Catatan Petugas</label>
                                                                        <textarea wire:model.defer="texts.{{ $item->id }}.kendala" id="kendala-{{ $item->id }}" rows="4" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition" placeholder="Tuliskan kendala atau catatan dari petugas..."></textarea>
                                                                    </div>
                                                                    <div>
                                                                        <label for="catatan-pemeriksa-{{ $item->id }}" class="block text-sm font-medium text-gray-700 mb-1">Catatan Pemeriksa</label>
                                                                        <textarea wire:model.defer="texts.{{ $item->id }}.catatan_pemeriksa" id="catatan-pemeriksa-{{ $item->id }}" rows="4" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition" placeholder="Tuliskan catatan dari pemeriksa..."></textarea>
                                                                    </div>
                                                                    <div class="flex justify-end items-center pt-2">
                                                                        <button type="button" wire:click="saveDetails({{ $item->id }})" wire:loading.attr="disabled" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:opacity-50">
                                                                            <svg wire:loading wire:target="saveDetails({{ $item->id }})" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                                                            <span>Simpan Semua Catatan</span>
                                                                        </button>
                                                                    </div>
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
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" /></svg>
                <h3 class="mt-2 text-lg font-medium text-gray-900">Data Checklist Kosong</h3>
                @if(!empty($search))
                    <p class="mt-1 text-base text-gray-500">
                        Tidak ada hasil yang cocok dengan pencarian "{{ $search }}".
                    </p>
                @else
                    <p class="mt-1 text-base text-gray-500">
                        Belum ada data checklist ZI yang tersedia di database.
                    </p>
                @endif
            </div>
        @endforelse
    </div>

    <div
        x-data="{ show: false }"
        x-show="show"
        @open-kendala-modal.window="show = true"
        @close-kendala-modal.window="show = false"
        x-transition:enter="ease-out duration-0"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-0"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-50 flex items-start justify-end p-4 sm:p-6"
        style="display: none;"
        x-cloak
    >
        {{-- Latar Belakang dengan Efek Blur --}}
        <div @click.stop="$wire.closeKendalaModal()" class="fixed inset-0 bg-gray-900/25 backdrop-blur-sm transition-opacity"></div>

        {{-- Konten Modal --}}
        <div class="relative w-full max-w-md bg-white rounded-xl shadow-2xl ring-1 ring-black ring-opacity-5">
            @if ($editingKendala)
                <div class="p-5">
                    <p class="text-sm font-medium text-gray-500">
                        Kendala untuk:
                    </p>
                    <h3 class="mt-1 text-base font-semibold text-gray-900">
                        {{ $editingKendala->pertanyaan }}
                    </h3>

                    @if ($editingKendala->kendala_updated_at)
                        <p class="mt-2 text-xs text-gray-400">
                            Terakhir diperbarui: 
                            <span class="font-medium text-gray-500">
                                {{-- Format tanggal agar mudah dibaca --}}
                                {{ $editingKendala->kendala_updated_at->format('d F Y, H:i') }}
                            </span>
                        </p>
                    @endif

                    <textarea 
                        wire:model="kendalaText" 
                        rows="5" 
                        class="mt-4 w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition" 
                        placeholder="Tuliskan kendala di sini..."
                    ></textarea>
                </div>

                {{-- Footer dengan Tombol Aksi --}}
                <div class="bg-gray-50 px-5 py-3 flex justify-end items-center space-x-3 rounded-b-xl">
                    <button 
                        type="button" 
                        wire:click="closeKendalaModal" 
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        Batal
                    </button>
                    <button 
                        type="button" 
                        wire:click="saveKendala" 
                        class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        Simpan
                    </button>
                </div>
            @endif
        </div>
    </div>
    <div
        x-data="{ show: false }"
        x-show="show"
        @open-rencana-aksi-modal.window="show = true"
        @close-rencana-aksi-modal.window="show = false"
        x-transition:enter="ease-out duration-0"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-0"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-50 flex items-start justify-end p-4 sm:p-6"
        style="display: none;"
        x-cloak
    >
        {{-- Latar Belakang --}}
        <div @click.stop="$wire.closeRencanaAksiModal()" class="fixed inset-0 bg-gray-900/25 backdrop-blur-sm transition-opacity"></div>

        {{-- Konten Modal --}}
        <div class="relative w-full max-w-md bg-white rounded-xl shadow-2xl ring-1 ring-black ring-opacity-5">
            @if ($editingRencanaAksi)
                <div class="p-5">
                    <p class="text-sm font-medium text-gray-500">
                        Rencana Aksi untuk:
                    </p>
                    <h3 class="mt-1 text-base font-semibold text-gray-900">
                        {{ $editingRencanaAksi->pertanyaan }}
                    </h3>

                    <textarea 
                        wire:model="rencanaAksiText" 
                        rows="5" 
                        class="mt-4 w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition" 
                        placeholder="Tuliskan rencana aksi di sini..."
                    ></textarea>
                </div>

                {{-- Footer dengan Tombol Aksi --}}
                <div class="bg-gray-50 px-5 py-3 flex justify-end items-center space-x-3 rounded-b-xl">
                    <button 
                        type="button" 
                        wire:click="closeRencanaAksiModal" 
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        Batal
                    </button>
                    <button 
                        type="button" 
                        wire:click="saveRencanaAksi" 
                        class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        Simpan
                    </button>
                </div>
            @endif
        </div>
    </div>
    {{-- MODAL UNTUK CATATAN PEMERIKSA --}}
    <div
        x-data="{ show: false }"
        x-show="show"
        @open-catatan-modal.window="show = true"
        @close-catatan-modal.window="show = false"
        x-transition:enter="ease-out duration-0"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-0"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-50 flex items-start justify-end p-4 sm:p-6"
        style="display: none;"
        x-cloak
    >
        {{-- Latar Belakang --}}
        <div @click.stop="$wire.closeCatatanPemeriksaModal()" class="fixed inset-0 bg-gray-900/25 backdrop-blur-sm transition-opacity"></div>

        {{-- Konten Modal --}}
        <div class="relative w-full max-w-md bg-white rounded-xl shadow-2xl ring-1 ring-black ring-opacity-5">
            @if ($editingCatatanPemeriksa)
                <div class="p-5">
                    <p class="text-sm font-medium text-gray-500">
                        Catatan untuk:
                    </p>
                    <h3 class="mt-1 text-base font-semibold text-gray-900">
                        {{ $editingCatatanPemeriksa->pertanyaan }}
                    </h3>

                    @if ($editingCatatanPemeriksa->timestamp_catatan_pemeriksa)
                        <p class="mt-2 text-xs text-gray-400">
                            Terakhir diperbarui: 
                            <span class="font-medium text-gray-500">
                                {{ $editingCatatanPemeriksa->timestamp_catatan_pemeriksa->format('d F Y, H:i') }}
                            </span>
                        </p>
                    @endif

                    <textarea 
                        wire:model="catatanPemeriksaText" 
                        rows="5" 
                        class="mt-4 w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition" 
                        placeholder="Tuliskan catatan di sini..."
                    ></textarea>
                </div>

                {{-- Footer dengan Tombol Aksi --}}
                <div class="bg-gray-50 px-5 py-3 flex justify-end items-center space-x-3 rounded-b-xl">
                    <button 
                        type="button" 
                        wire:click="closeCatatanPemeriksaModal" 
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        Batal
                    </button>
                    <button 
                        type="button" 
                        wire:click="saveCatatanPemeriksa" 
                        class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        Simpan
                    </button>
                </div>
            @endif
        </div>
    </div>

    <div x-data="{ show: false, files: [] }"
        x-show="show"
        @open-file-modal.window="show = true; files = $event.detail.files"
        @click.away="show = false"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="fixed inset-0 z-[9999] flex items-center justify-center p-4"
        style="display: none;">

        {{-- Latar belakang --}}
        <div class="fixed inset-0 bg-black/50"></div>

        {{-- Konten pop-up --}}
        <div class="relative bg-white rounded-lg shadow-2xl p-6 w-full max-w-sm sm:max-w-md max-h-[80vh] overflow-y-auto transform transition-all">
            <div class="flex items-start justify-between">
                <h3 class="text-xl font-bold text-gray-800">Daftar File</h3>
                <button @click="show = false" class="text-gray-400 hover:text-gray-600 transition">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <p class="text-sm text-gray-500 mt-1 mb-4">File yang ditemukan di folder Google Drive.</p>

            <ul class="space-y-2 divide-y divide-gray-200">
                <template x-if="files.length > 0">
                    <template x-for="file in files" :key="file.name">
                        <li class="flex items-center space-x-2 pt-2 first:pt-0">
                            <svg class="h-4 w-4 text-gray-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0011.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                            <a :href="file.link" target="_blank" class="truncate text-sm text-blue-600 hover:underline" :title="file.name" x-text="file.name"></a>
                        </li>
                    </template>
                </template>
                <template x-if="files.length === 0">
                    <p class="text-sm text-gray-500 italic text-center py-4">
                        (Folder ini kosong atau cache belum ter-update)
                    </p>
                </template>
            </ul>
        </div>
    </div>
</div>

<div class="p-6 md:p-8 text-gray-900">
    {{-- Judul dan Tombol Aksi --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 pb-6 border-b border-gray-200">
        <div>
            <h3 class="text-2xl font-bold text-gray-800">Daftar Checklist Zona Integritas</h3>
            <p class="text-base text-gray-500 mt-1">BPS Kabupaten Nias</p>
        </div>
        
        {{-- Tombol ini sekarang memanggil method 'syncStatus' di komponen Livewire --}}
        <button 
            type="button"
            wire:click="syncStatus"
            wire:loading.attr="disabled"
            class="mt-4 sm:mt-0 flex items-center space-x-2 bg-blue-600 hover:bg-blue-700 text-white font-bold px-5 py-2.5 rounded-lg transition duration-300 text-base shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 disabled:opacity-50 disabled:cursor-wait">
            
            {{-- Indikator Loading --}}
            <svg wire:loading wire:target="syncStatus" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>

            {{-- Ikon Default --}}
            <svg wire:loading.remove wire:target="syncStatus" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a5.002 5.002 0 008.057 2.332 1 1 0 11.886 1.786A7.002 7.002 0 014.999 17v-2.101a1 1 0 011.885-.666 1 1 0 01.115.033z" clip-rule="evenodd" /></svg>
            
            <span>Sinkronkan Status</span>
        </button>
    </div>

    {{-- FITUR PENCARIAN (Menggunakan Livewire) --}}
    <div class="mb-6">
        <input 
            type="text" 
            wire:model.live.debounce.300ms="search"
            placeholder="Cari berdasarkan kata kunci..."
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
    </div>

    {{-- STRUKTUR AKORDEON UTAMA --}}
    <div class="space-y-4">
        @forelse ($checklists as $aspek => $areas)
            <div x-data="{ open: true }" class="border border-gray-300 rounded-xl shadow-sm transition-shadow hover:shadow-md">
                <div @click="open = !open" class="w-full flex justify-between items-center p-4 cursor-pointer bg-gray-100 rounded-t-xl hover:bg-gray-200">
                    <span class="text-xl font-bold text-gray-800 tracking-wide">{{ $aspek }}</span>
                    <svg class="w-6 h-6 transform transition-transform text-gray-600" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </div>
                <div x-show="open" x-transition class="p-4 border-t border-gray-300 space-y-3 bg-white rounded-b-xl">
                    @foreach ($areas as $area => $pilars)
                        <div x-data="{ open: false }" class="bg-white border border-blue-300 rounded-lg">
                            <div @click="open = !open" class="w-full flex justify-between items-center p-3 cursor-pointer bg-blue-50 hover:bg-blue-100">
                                <span class="text-lg font-semibold text-blue-900">{{ $area }}</span>
                                <svg class="w-5 h-5 transform transition-transform text-blue-500" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                            <div x-show="open" x-transition class="px-4 py-2 border-t border-blue-200 space-y-3">
                                @foreach ($pilars as $pilar => $sub_pilars)
                                    <div x-data="{ open: false }" class="border-t border-gray-200 pt-2">
                                        <div @click="open = !open" class="w-full flex justify-between items-center py-2 cursor-pointer hover:bg-gray-50 rounded-md px-2">
                                            <span class="font-medium text-gray-800 text-base">{{ $pilar }}</span>
                                            <svg class="w-5 h-5 transform transition-transform text-gray-500" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                        </div>
                                        <div x-show="open" x-transition class="pl-4 pt-2 mt-1 border-l-2 border-blue-300 space-y-2">
                                            @foreach ($sub_pilars as $sub_pilar => $pertanyaans)
                                                <div x-data="{ open: false }">
                                                    <div @click="open = !open" class="w-full flex justify-between items-center py-2 cursor-pointer hover:bg-gray-50 rounded-md px-2">
                                                        <span class="italic text-gray-600 text-base">{{ $sub_pilar }}</span>
                                                        <svg class="w-5 h-5 transform transition-transform text-gray-500" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                                    </div>
                                                    <div x-show="open" x-transition class="pl-4">
                                                        {{-- INI ADALAH PERULANGAN YANG MEMPERBAIKI ERROR --}}
                                                        @foreach ($pertanyaans as $item)
                                                            <div class="flex flex-wrap items-center justify-between py-3 gap-4">
                                                                {{-- Kolom Pertanyaan (fleksibel) --}}
                                                                <p class="text-gray-800 flex-1 min-w-0 pr-4">{{ $item->pertanyaan }}</p>

                                                                {{-- Kolom Aksi (lebar tetap) --}}
                                                                <div class="flex items-center space-x-3 flex-shrink-0">
                                                                    {{-- Dropdown Petugas --}}
                                                                    <div class="w-40">
                                                                        <select 
                                                                            wire:model.live="assignedPetugas.{{ $item->id }}"
                                                                            class="block w-full text-sm border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 rounded-md"
                                                                            title="Pilih Penanggung Jawab"
                                                                        >
                                                                            <option value="">-- PCL --</option>
                                                                            @foreach($petugasList as $petugas)
                                                                                <option value="{{ $petugas->id }}">{{ $petugas->nama }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    
                                                                    {{-- Status Badge --}}
                                                                    <span class="w-20 text-center text-sm font-semibold rounded-full px-3 py-1 {{ $item->status == 'Terisi' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                                        {{ $item->status }}
                                                                    </span>
                                                                    
                                                                    @if($item->google_drive_folder_id)
                                                                        {{-- Tombol Upload --}}
                                                                        <a href="https://drive.google.com/drive/folders/{{ $item->google_drive_folder_id }}" target="_blank" class="p-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition" title="Upload ke Drive">
                                                                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="100" height="100" viewBox="0 0 48 48">
                                                                        <path fill="#1e88e5" d="M38.59,39c-0.535,0.93-0.298,1.68-1.195,2.197C36.498,41.715,35.465,42,34.39,42H13.61 c-1.074,0-2.106-0.285-3.004-0.802C9.708,40.681,9.945,39.93,9.41,39l7.67-9h13.84L38.59,39z"></path><path fill="#fbc02d" d="M27.463,6.999c1.073-0.002,2.104-0.716,3.001-0.198c0.897,0.519,1.66,1.27,2.197,2.201l10.39,17.996 c0.537,0.93,0.807,1.967,0.808,3.002c0.001,1.037-1.267,2.073-1.806,3.001l-11.127-3.005l-6.924-11.993L27.463,6.999z"></path><path fill="#e53935" d="M43.86,30c0,1.04-0.27,2.07-0.81,3l-3.67,6.35c-0.53,0.78-1.21,1.4-1.99,1.85L30.92,30H43.86z"></path><path fill="#4caf50" d="M5.947,33.001c-0.538-0.928-1.806-1.964-1.806-3c0.001-1.036,0.27-2.073,0.808-3.004l10.39-17.996 c0.537-0.93,1.3-1.682,2.196-2.2c0.897-0.519,1.929,0.195,3.002,0.197l3.459,11.009l-6.922,11.989L5.947,33.001z"></path><path fill="#1565c0" d="M17.08,30l-6.47,11.2c-0.78-0.45-1.46-1.07-1.99-1.85L4.95,33c-0.54-0.93-0.81-1.96-0.81-3H17.08z"></path><path fill="#2e7d32" d="M30.46,6.8L24,18L17.53,6.8c0.78-0.45,1.66-0.73,2.6-0.79L27.46,6C28.54,6,29.57,6.28,30.46,6.8z"></path>
                                                                        </svg>
                                                                        </a>
                                                                    
                                                                        {{-- Tombol Copy Link --}}
                                                                        <button wire:click="copyLink('{{ $item->google_drive_folder_id }}')" title="Copy Link">
                                                                            <img class="h-6 w-6" src="https://img.icons8.com/ios/50/copy-link.png" alt="copy-link" />
                                                                        </button>

                                                                        @script
                                                                        <script>
                                                                            $wire.on('copy-to-clipboard', ({ text }) => {
                                                                                // Cek apakah Clipboard API didukung
                                                                                if (navigator.clipboard) {
                                                                                    navigator.clipboard.writeText(text).then(() => {
                                                                                        console.log('Tautan berhasil disalin menggunakan Clipboard API!');
                                                                                    }).catch(err => {
                                                                                        console.error('Gagal menyalin:', err);
                                                                                    });
                                                                                } else {
                                                                                    // Jika tidak didukung, gunakan fallback (metode lama)
                                                                                    const textArea = document.createElement("textarea");
                                                                                    textArea.value = text;
                                                                                    textArea.style.position = "fixed";  // Hindari scroll
                                                                                    textArea.style.top = "0";
                                                                                    textArea.style.left = "-9999px"; // Posisikan di luar layar
                                                                                    document.body.appendChild(textArea);
                                                                                    textArea.focus();
                                                                                    textArea.select();
                                                                                    
                                                                                    try {
                                                                                        const successful = document.execCommand('copy');
                                                                                        if (successful) {
                                                                                            console.log('Tautan berhasil disalin menggunakan document.execCommand!');
                                                                                        } else {
                                                                                            console.error('Gagal menyalin menggunakan fallback.');
                                                                                        }
                                                                                    } catch (err) {
                                                                                        console.error('Gagal menyalin:', err);
                                                                                    }
                                                                                    
                                                                                    document.body.removeChild(textArea);
                                                                                }
                                                                            });
                                                                        </script>
                                                                        @endscript
                                                                    @endif

                                                                    {{-- Tombol Kendala --}}
                                                                    <button wire:click="editKendala({{ $item->id }})" class="p-2 rounded-md transition {{ $item->kendala ? 'bg-yellow-400 text-white hover:bg-yellow-500' : 'bg-gray-200 text-gray-600 hover:bg-gray-300' }}" title="Tambah/Edit Kendala">
                                                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-7-4a1 1 0 1 1-2 0 1 1 0 0 1 2 0ZM9 9a1 1 0 0 0 0 2v3a1 1 0 0 0 1 1h1a1 1 0 1 0 0-2v-3a1 1 0 0 0-1-1H9Z" clip-rule="evenodd" /></svg>
                                                                    </button>
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
        <div @click="$wire.closeKendalaModal()" class="fixed inset-0 bg-gray-900/25 backdrop-blur-sm transition-opacity"></div>

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
</div>

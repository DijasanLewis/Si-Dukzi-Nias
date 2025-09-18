<div class="p-6 md:p-8 text-gray-900">
    {{-- Header Container --}}
    <div class="flex flex-col sm:flex-row justify-between items-center sm:items-start mb-6 pb-6 border-b border-gray-200">

        {{-- Judul dan Sub-judul (Kiri di desktop, Tengah di mobile) --}}
        <div class="text-center sm:text-left w-auto sm:w-2/3">
            <h3 class="text-2xl font-bold text-gray-800">Daftar Checklist Zona Integritas</h3>
            <p class="text-gray-500 mt-1">BPS Kabupaten Nias</p>
        </div>

        {{-- Tombol dan Keterangan (Kanan di desktop, Tengah di mobile) --}}
        <div class="w-auto sm:w-1/3 flex flex-col items-center sm:items-end mt-2 sm:mt-0 gap-2">
            <button 
                type="button"
                wire:click="syncStatus"
                wire:loading.attr="disabled"
                class="w-full sm:w-auto flex justify-center sm:justify-end items-center space-x-2 bg-blue-600 hover:bg-blue-700 text-white font-bold px-5 py-2.5 rounded-lg transition duration-300 text-base shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 disabled:opacity-50 disabled:cursor-wait">
                
                <svg wire:loading wire:target="syncStatus" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            
                <span>Update Status (Terisi/Kosong)</span>
            </button>
            <div class="text-center sm:text-right">
                <p class="text-xs text-gray-500">
                    Update untuk memperbarui status dan isi folder dari Google Drive. Misalnya saat file diupload atau dihapus dari folder.
                </p>
            </div>
        </div>
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
                                                            <div class="flex flex-wrap flex-col sm:flex-row items-center justify-around py-3 gap-4">
                                                                {{-- Kolom Pertanyaan (fleksibel) --}}
                                                                <p class="text-gray-800 flex-1 w-full sm:w-3/4 pr-4 ">{{ $item->pertanyaan }}</p>

                                                                {{-- Kolom Aksi (lebar tetap) --}}
                                                                <div class="flex flex-row items-center justify-between w-full sm:w-1/3">
                                                                    {{-- Dropdown Petugas (untuk Admin) atau Nama Petugas (untuk non-admin) --}}
                                                                    <div class="w-1/3 flex-1">
                                                                        @if(auth()->user()->is_admin)
                                                                            <select 
                                                                                wire:model.live="assignedPetugas.{{ $item->id }}"
                                                                                class="block w-full text-sm border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 ease-in-out"
                                                                                title="Pilih Petugas"
                                                                            >
                                                                                <option value="">-- Assign Petugas --</option>
                                                                                @foreach($petugasList as $petugas)
                                                                                    <option value="{{ $petugas->id }}">{{ $petugas->nama }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        @else
                                                                            {{-- Tampilan untuk non-admin --}}
                                                                            @if ($item->petugas)
                                                                                <div class="px-3 py-1.5 bg-indigo-50 border border-indigo-200 rounded-lg shadow-sm w-full">
                                                                                    <p class="text-sm font-semibold text-indigo-800 truncate" title="{{ $item->petugas->nama }}">
                                                                                        {{ $item->petugas->nama }}
                                                                                    </p>
                                                                                </div>
                                                                            @else
                                                                                <div class="px-3 py-1.5 bg-gray-100 border border-gray-300 rounded-lg shadow-sm w-full">
                                                                                    <p class="text-sm italic text-gray-500">
                                                                                        Belum di-assign
                                                                                    </p>
                                                                                </div>
                                                                            @endif
                                                                        @endif
                                                                    </div>

                                                                    
                                                                    {{-- Status Badge --}}
                                                                    <div class="w-1/5 flex flex-col justify-between items-center mx-auto">
                                                                        @if ($item->status == 'Terisi')
                                                                        <button 
                                                                            @click.prevent.stop="$dispatch('open-file-modal', { files: @js($cachedFiles[$item->id] ?? []) })"
                                                                            class="justify-between items-center text-xs text-center leading-5 font-semibold rounded-full bg-green-100 text-green-800 hover:bg-green-200 focus:outline-none w-4/5">
                                                                            Terisi
                                                                        </button>
                                                                        @else
                                                                            <span class="justify-between items-center text-xs text-center leading-5 font-semibold rounded-full bg-red-100 text-red-800 w-4/5">
                                                                                Kosong
                                                                            </span>
                                                                        @endif
                                                                    </div>
                                                                    
                                                                    {{-- Kebab Menu untuk Aksi Lainnya --}}
                                                                        <div x-data="{ open: false }" class="relative">
                                                                            {{-- Tombol Pemicu Kebab Menu --}}
                                                                            <button @click="open = !open" @click.away="open = false" class="p-1.5 rounded-full hover:bg-gray-200 text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                                                <svg class="h-5 w-5" xmlns="http://www.w.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                                                    <path d="M10 3a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM10 8.5a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM11.5 15.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0Z" />
                                                                                </svg>
                                                                            </button>

                                                                            {{-- Panel Dropdown Aksi --}}
                                                                            <div 
                                                                                x-show="open" 
                                                                                x-transition 
                                                                                class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                                                                style="display: none;"
                                                                                x-cloak
                                                                                >
                                                                                <div class="py-1" role="menu" aria-orientation="vertical">
                                                                                    @if($item->google_drive_folder_id)
                                                                                        <a href="https://drive.google.com/drive/folders/{{ $item->google_drive_folder_id }}" target="_blank" class="text-gray-700 block w-full text-left px-4 py-2 text-sm hover:bg-gray-100" role="menuitem">Upload ke Drive</a>
                                                                                        <button wire:click="copyLink('{{ $item->google_drive_folder_id }}')" @click.stop="open = false" class="text-gray-700 block w-full text-left px-4 py-2 text-sm hover:bg-gray-100" role="menuitem">Copy Link</button>
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
                                                                                    {{-- Tombol untuk Kendala --}}
                                                                                    <button wire:click="editKendala({{ $item->id }})" @click.stop="open = false" class="text-gray-700 block w-full text-left px-4 py-2 text-sm hover:bg-gray-100 {{ $item->kendala ? 'font-bold' : '' }}" role="menuitem">
                                                                                        {{ $item->kendala ? 'Edit Kendala' : 'Tambah Kendala' }}
                                                                                    </button>
                                                                                    {{-- Tombol untuk Rencana Aksi --}}
                                                                                    <button wire:click="editRencanaAksi({{ $item->id }})" @click.stop="open = false" class="text-gray-700 block w-full text-left px-4 py-2 text-sm hover:bg-gray-100 {{ $item->rencana_aksi ? 'font-bold' : '' }}" role="menuitem">
                                                                                        {{ $item->rencana_aksi ? 'Edit Rencana Aksi' : 'Tambah Rencana Aksi' }}
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    <div>
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

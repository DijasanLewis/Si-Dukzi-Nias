<div class="bg-gray-100 min-h-screen">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12">

        {{-- HEADER --}}
        <header class="mb-8">
            <h1 class="text-3xl sm:text-4xl font-bold text-gray-800 tracking-tight">Dashboard Monitoring Pilar</h1>
            <p class="mt-2 text-lg text-gray-600">Progres Pencapaian Target Mingguan Berdasarkan Kategori</p>
        </header>

        {{-- FILTER --}}
        <div class="mb-6 p-4 bg-white rounded-lg shadow-sm border flex items-center gap-4">
             <h4 class="text-lg font-semibold text-gray-700 flex-shrink-0">Filter Data</h4>
            
            <div class="w-full sm:w-auto">
                <select wire:model.live="selectedYear" class="w-full form-select block pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md text-gray-900">
                    @foreach($years as $year)
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endforeach
                </select>
            </div>

            <div class="w-full sm:w-auto">
                <select wire:model.live="selectedMonth" class="w-full form-select block pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md text-gray-900">
                    @foreach($months as $month)
                        <option value="{{ $month }}">{{ \Carbon\Carbon::create()->month($month)->translatedFormat('F') }}</option>
                    @endforeach
                </select>
            </div>
        </div>


        {{-- TABEL MONITORING --}}
        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200">
            <div>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-5/12">Kategori Hierarki</th>
                            <th class="px-2 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-1/12">Total Target</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-2/12">Progress Bulan Ini</th>
                            @for ($m = 1; $m <= 4; $m++)
                                <th class="px-2 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-1/12">M{{$m}}</th>
                            @endfor
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @if (empty($data))
                            <tr>
                                <td colspan="7" class="text-center py-12 text-gray-500">
                                    Tidak ada data target untuk periode yang dipilih.
                                </td>
                            </tr>
                        @else
                           {{-- Panggil view parsial secara rekursif --}}
                            @include('livewire.partials.pilar-monitoring-row', ['items' => $data, 'level' => 0, 'parent_key' => ''])
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
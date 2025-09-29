@foreach ($items as $key => $item)
    @php
        $current_key = $parent_key ? $parent_key . '|' . $key : $key;
        $hasChildren = !empty($item['children']);
        $isExpanded = in_array($current_key, $expandedRows);
    @endphp

    {{-- Baris ini berfungsi sebagai kontainer untuk tampilan desktop dan mobile --}}
    <tr class="hover:bg-gray-50">
        
        {{-- TAMPILAN DESKTOP (sm dan lebih besar) --}}
        <td class="hidden sm:table-cell px-6 py-4 whitespace-nowrap" style="padding-left: {{ 1.5 + ($level * 1.25) }}rem;">
            <div class="flex items-center">
                @if ($hasChildren)
                    <button wire:click="toggleRow('{{ $current_key }}')" class="mr-2 text-gray-500 hover:text-gray-800">
                        <svg class="w-4 h-4 transform transition-transform" style="{{ $isExpanded ? 'transform: rotate(90deg);' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </button>
                @else
                    <span class="inline-block w-4 h-4 mr-2"></span> {{-- Spacer --}}
                @endif
                <span class="font-medium text-gray-900">{{ $item['name'] }}</span>
            </div>
        </td>
        <td class="hidden sm:table-cell px-2 py-4 whitespace-nowrap text-center text-sm text-gray-800 font-bold">{{ $item['monthly_total'] }}</td>
        <td class="hidden sm:table-cell px-6 py-4 whitespace-nowrap">
            <div class="flex items-center">
                <div class="w-full bg-gray-200 rounded-full h-5"><div class="h-5 rounded-full text-white text-xs flex items-center justify-center font-bold" style="width: {{ $item['monthly_percentage'] }}%; background: linear-gradient(to right, #fca5a5, #a3e635);">{{ $item['monthly_percentage'] }}%</div></div>
            </div>
        </td>
        @for ($m = 1; $m <= 4; $m++)
            <td class="hidden sm:table-cell px-2 py-4 whitespace-nowrap text-center">
                @if ($item['weekly_stats'][$m]['total'] > 0)
                <span class="text-xs font-bold py-1 px-2 rounded" style="background-color: {{ $item['weekly_stats'][$m]['color'] }}; color: {{ $item['weekly_stats'][$m]['percentage'] > 50 ? 'white' : 'black' }};">{{ $item['weekly_stats'][$m]['percentage'] }}%</span>
                @else - @endif
            </td>
        @endfor

        {{-- TAMPILAN MOBILE (di bawah sm) --}}
        <td class="block sm:hidden p-3" colspan="7">
            <div style="padding-left: {{ $level * 1.25 }}rem;">
                {{-- Baris Nama Kategori --}}
                <div class="flex items-center mb-3">
                    @if ($hasChildren)
                        <button wire:click="toggleRow('{{ $current_key }}')" class="mr-2 text-gray-500 hover:text-gray-800">
                           <svg class="w-4 h-4 transform transition-transform" style="{{ $isExpanded ? 'transform: rotate(90deg);' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </button>
                    @else
                        <span class="inline-block w-4 h-4 mr-2"></span>
                    @endif
                    <span class="font-medium text-gray-900 flex-grow">{{ $item['name'] }}</span>
                    <span class="text-xs font-bold text-gray-600 bg-gray-200 px-2 py-1 rounded">
                        {{ $item['monthly_total'] }} Target
                    </span>
                </div>

                {{-- Progress Bar Bulanan --}}
                <div class="mb-3">
                    <p class="text-xs font-semibold text-gray-500 mb-1">Progress Bulan Ini:</p>
                    <div class="w-full bg-gray-200 rounded-full h-5"><div class="h-5 rounded-full text-white text-xs flex items-center justify-center font-bold" style="width: {{ $item['monthly_percentage'] }}%; background: linear-gradient(to right, #fca5a5, #a3e635);">{{ $item['monthly_percentage'] }}%</div></div>
                </div>

                {{-- Grid Mingguan --}}
                <div class="grid grid-cols-4 gap-2 text-center">
                    @for ($m = 1; $m <= 4; $m++)
                        <div>
                            <p class="text-xs font-bold text-gray-500 mb-1">M{{$m}}</p>
                             @if ($item['weekly_stats'][$m]['total'] > 0)
                                <span class="text-xs font-bold py-1 px-2 rounded" style="background-color: {{ $item['weekly_stats'][$m]['color'] }}; color: {{ $item['weekly_stats'][$m]['percentage'] > 50 ? 'white' : 'black' }};">{{ $item['weekly_stats'][$m]['percentage'] }}%</span>
                            @else - @endif
                        </div>
                    @endfor
                </div>
            </div>
        </td>

    </tr>
    
    @if ($isExpanded && $hasChildren)
        @include('livewire.partials.pilar-monitoring-row', ['items' => $item['children'], 'level' => $level + 1, 'parent_key' => $current_key])
    @endif
@endforeach
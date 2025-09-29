@foreach ($items as $key => $item)
    @php
        // Buat key unik untuk setiap baris agar bisa di-expand
        $current_key = $parent_key ? $parent_key . '|' . $key : $key;
        $hasChildren = !empty($item['children']);
        $isExpanded = in_array($current_key, $expandedRows);
    @endphp

    <tr class="hover:bg-gray-50">
        {{-- Kolom Nama Kategori --}}
        <td class="px-6 py-4 whitespace-nowrap">
            <div class="flex items-center" style="padding-left: {{ $level * 20 }}px;">
                @if ($hasChildren)
                    <button wire:click="toggleRow('{{ $current_key }}')" class="mr-2 text-gray-500 hover:text-gray-800">
                        <svg class="w-4 h-4 transform transition-transform" style="{{ $isExpanded ? 'transform: rotate(90deg);' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </button>
                @else
                    <span class="w-4 h-4 mr-2"></span> {{-- Spacer --}}
                @endif
                <span class="font-medium text-gray-900">{{ $item['name'] }}</span>
            </div>
        </td>

        {{-- Kolom Total Target --}}
        <td class="px-2 py-4 whitespace-nowrap text-center text-sm text-gray-800 font-bold">
            {{ $item['monthly_total'] }}
        </td>

        {{-- Kolom Progress Bar Bulanan --}}
        <td class="px-6 py-4 whitespace-nowrap">
            <div class="flex items-center">
                <div class="w-full bg-gray-200 rounded-full h-5">
                    <div class="h-5 rounded-full text-white text-xs flex items-center justify-center font-bold" 
                         style="width: {{ $item['monthly_percentage'] }}%; background: linear-gradient(to right, #fca5a5, #a3e635);">
                        {{ $item['monthly_percentage'] }}%
                    </div>
                </div>
            </div>
        </td>

        {{-- Kolom Mingguan (M1-M4) --}}
        @for ($m = 1; $m <= 4; $m++)
            <td class="px-2 py-4 whitespace-nowrap text-center">
                @if ($item['weekly_stats'][$m]['total'] > 0)
                <span class="text-xs font-bold py-1 px-2 rounded" 
                      style="background-color: {{ $item['weekly_stats'][$m]['color'] }}; color: {{ $item['weekly_stats'][$m]['percentage'] > 50 ? 'white' : 'black' }};">
                    {{ $item['weekly_stats'][$m]['percentage'] }}%
                </span>
                @else
                    -
                @endif
            </td>
        @endfor
    </tr>
    
    {{-- Jika baris ini di-expand dan punya anak, panggil lagi view ini untuk anak-anaknya --}}
    @if ($isExpanded && $hasChildren)
        @include('livewire.partials.pilar-monitoring-row', ['items' => $item['children'], 'level' => $level + 1, 'parent_key' => $current_key])
    @endif

@endforeach
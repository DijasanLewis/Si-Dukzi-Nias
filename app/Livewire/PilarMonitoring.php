<?php

namespace App\Livewire;

use App\Models\TargetMingguan;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Models\ZIChecklist; 

class PilarMonitoring extends Component
{
    public int $selectedYear;
    public int $selectedMonth;
    public array $years = [];
    public array $months = [];

    // Untuk menyimpan ID baris yang sedang dibuka/di-expand
    public array $expandedRows = [];

    public function mount()
    {
        // Inisialisasi filter
        $this->years = TargetMingguan::select('tahun')->distinct()->orderBy('tahun', 'desc')->pluck('tahun')->toArray();
        if (empty($this->years)) {
            $this->years = [now()->year];
        }
        $this->months = range(1, 12);
        $this->selectedYear = now()->year;
        $this->selectedMonth = now()->month;

        // Untuk membuka dropdown secara default
        $this->initializeExpandedRows();
    }

    /**
     * Fungsi untuk mengisi state expandedRows agar 3 level pertama terbuka.
     */
    public function initializeExpandedRows(): void
    {
        // Ambil semua kombinasi unik dari 3 level pertama, diurutkan dengan benar.
        $hierarchies = ZIChecklist::select('aspek', 'area')
            ->distinct()
            ->orderBy('aspek')
            ->orderBy('area')
            ->get();

        $keysToExpand = [];
        foreach ($hierarchies as $row) {
            $key1 = $row->aspek;
            $key2 = $key1 . '|' . $row->area;
            $key3 = $key2 . '|' . $row->pilar;
            
            // Tambahkan semua level ke dalam array
            if (!in_array($key1, $keysToExpand)) $keysToExpand[] = $key1;
            if (!in_array($key2, $keysToExpand)) $keysToExpand[] = $key2;
        }

        $this->expandedRows = $keysToExpand;
    }

    public function toggleRow(string $key)
    {
        if (in_array($key, $this->expandedRows)) {
            // Jika sudah ada, hapus (tutup)
            $this->expandedRows = array_diff($this->expandedRows, [$key]);
        } else {
            // Jika belum ada, tambahkan (buka)
            $this->expandedRows[] = $key;
        }
    }
    
    // Fungsi helper untuk mendapatkan warna berdasarkan persentase
    private function getColorForPercentage($percentage)
    {
        if ($percentage < 10) return '#ef4444'; // Merah terang
        if ($percentage < 50) return '#f87171'; // Merah
        if ($percentage < 75) return '#fbbf24'; // Kuning
        if ($percentage < 90) return '#a3e635'; // Hijau muda
        return '#4d7c0f'; // Hijau tua
    }

    public function render()
    {
        // 1. Ambil data mentah dari DB
        $rawData = TargetMingguan::join('z_i_checklists', 'target_mingguan.pertanyaan_id', '=', 'z_i_checklists.id')
            ->where('target_mingguan.tahun', $this->selectedYear)
            ->where('target_mingguan.bulan', $this->selectedMonth)
            ->whereIn('target_mingguan.status', [0, 1])
            ->select(
                'z_i_checklists.aspek', 'z_i_checklists.area', 'z_i_checklists.pilar', 'z_i_checklists.sub_pilar', 'z_i_checklists.pertanyaan', 'target_mingguan.minggu',
                DB::raw('COUNT(target_mingguan.id) as total_target'),
                DB::raw('SUM(CASE WHEN target_mingguan.status = 1 THEN 1 ELSE 0 END) as tercapai')
            )
            ->groupBy('aspek', 'area', 'pilar', 'sub_pilar', 'z_i_checklists.pertanyaan', 'minggu')
            ->orderBy('z_i_checklists.aspek') // Mengurutkan hasil akhir
            ->orderBy('z_i_checklists.area')
            ->orderBy('z_i_checklists.pilar')
            ->orderBy('z_i_checklists.sub_pilar')
            ->orderBy('z_i_checklists.pertanyaan')
            ->get();
            
        // 2. Transformasi data menjadi struktur hierarki
        $hierarchy = [];
        
        foreach ($rawData as $item) {
            $keys = [$item->aspek, $item->area, $item->pilar, $item->sub_pilar, $item->pertanyaan];
            $currentLevel = &$hierarchy;
            
            foreach ($keys as $key) {
                if (empty($key)) continue;
                if (!isset($currentLevel[$key])) {
                    $currentLevel[$key] = [
                        'name' => $key,
                        'children' => [],
                        'weekly_stats' => [1 => ['total'=>0, 'done'=>0], 2 => ['total'=>0, 'done'=>0], 3 => ['total'=>0, 'done'=>0], 4 => ['total'=>0, 'done'=>0]],
                    ];
                }
                // Akumulasi statistik ke level induk
                $currentLevel[$key]['weekly_stats'][$item->minggu]['total'] += $item->total_target;
                $currentLevel[$key]['weekly_stats'][$item->minggu]['done'] += $item->tercapai;
                
                $currentLevel = &$currentLevel[$key]['children'];
            }
        }

        // 3. Fungsi rekursif untuk menghitung persentase dan total
        $calculateStats = function(&$level) use (&$calculateStats) {
            foreach ($level as &$node) {
                if (!empty($node['children'])) {
                    $calculateStats($node['children']);
                }
                
                $monthlyTotal = 0;
                $monthlyDone = 0;
                for ($m=1; $m<=4; $m++) {
                    $week = $node['weekly_stats'][$m];
                    $monthlyTotal += $week['total'];
                    $monthlyDone += $week['done'];
                    $percentage = ($week['total'] > 0) ? round(($week['done'] / $week['total']) * 100) : 0;
                    $node['weekly_stats'][$m]['percentage'] = $percentage;
                    $node['weekly_stats'][$m]['color'] = $this->getColorForPercentage($percentage);
                }
                $node['monthly_total'] = $monthlyTotal;
                $node['monthly_done'] = $monthlyDone;
                $node['monthly_percentage'] = ($monthlyTotal > 0) ? round(($monthlyDone / $monthlyTotal) * 100) : 0;
            }
        };

        $calculateStats($hierarchy);

        return view('livewire.pilar-monitoring', [
            'data' => $hierarchy
        ])->layout('layouts.app');
    }
}

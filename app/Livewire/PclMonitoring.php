<?php

namespace App\Livewire;

use App\Models\Petugas;
use App\Models\ZIChecklist;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use HighSolutions\LaravelSearchy\Facades\Searchy;

class PclMonitoring extends Component
{
    public ?int $expandedPetugasId = null;
    public string $search = '';

    public function toggleDetails(int $petugasId)
    {
        if ($this->expandedPetugasId === $petugasId) {
            $this->expandedPetugasId = null;
        } else {
            $this->expandedPetugasId = $petugasId;
        }
    }

    public function render()
    {
        $petugasQuery = Petugas::query()
            ->whereHas('zIChecklists')
            ->with('zIChecklists');

        // --- LOGIKA PENCARIAN DENGAN SEARCHY ---
        if (!empty($this->search)) {
            // 1. Cari ID petugas menggunakan Searchy
            $petugasIds = collect(
                Searchy::search('petugas')
                    ->fields('nama')
                    ->query($this->search)
                    ->get()
            )->pluck('id');

            // 2. Filter query utama berdasarkan ID yang ditemukan
            $petugasQuery->whereIn('id', $petugasIds);
        }

        $petugasDenganTugas = $petugasQuery->get();
        // --- AKHIR LOGIKA PENCARIAN ---

        $statistikPetugas = $petugasDenganTugas->map(function ($petugas) {
            $totalTugas = $petugas->zIChecklists->count();
            $tugasSelesai = $petugas->zIChecklists->where('status', 'Terisi')->count();
            $persentase = ($totalTugas > 0) ? ($tugasSelesai / $totalTugas) * 100 : 0;

            return (object) [
                'id' => $petugas->id,
                'nama' => $petugas->nama,
                'total_tugas' => $totalTugas,
                'tugas_selesai' => $tugasSelesai,
                'persentase' => round($persentase),
                'tasks' => $petugas->zIChecklists->sortBy('id'),
            ];
        });

        // Statistik keseluruhan tidak terpengaruh oleh pencarian
        $totalTugasKeseluruhan = ZIChecklist::whereNotNull('petugas_id')->count();
        $tugasSelesaiKeseluruhan = ZIChecklist::where('status', 'Terisi')->whereNotNull('petugas_id')->count();
        $persentaseKeseluruhan = ($totalTugasKeseluruhan > 0) ? ($tugasSelesaiKeseluruhan / $totalTugasKeseluruhan) * 100 : 0;

        $overallStats = (object) [
            'total_tugas' => $totalTugasKeseluruhan,
            'tugas_selesai' => $tugasSelesaiKeseluruhan,
            'persentase' => round($persentaseKeseluruhan),
            'last_sync' => ZIChecklist::max('updated_at'),
        ];

        return view('livewire.pcl-monitoring', [
            'statistikPetugas' => $statistikPetugas,
            'overallStats' => $overallStats,
        ])->layout('layouts.app');
    }
}
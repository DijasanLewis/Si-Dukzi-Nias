<?php

namespace App\Livewire;

use App\Models\Petugas;
use App\Models\ZIChecklist;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class PclMonitoring extends Component
{
    public ?int $expandedPetugasId = null;

    public function toggleDetails(int $petugasId)
    {
        // Jika mengklik petugas yang sudah terbuka, tutup. Jika tidak, buka yang baru.
        if ($this->expandedPetugasId === $petugasId) {
            $this->expandedPetugasId = null;
        } else {
            $this->expandedPetugasId = $petugasId;
        }
    }

    public function render()
    {
        // Ambil hanya petugas yang memiliki setidaknya satu tugas
        $petugasDenganTugas = Petugas::has('zIChecklists')->with('zIChecklists')->get();

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
                'tasks' => $petugas->zIChecklists->sortBy('id'), // Kirim detail tugas
            ];
        });

        // Hitung statistik keseluruhan
        $totalTugasKeseluruhan = ZIChecklist::whereNotNull('petugas_id')->count();
        $tugasSelesaiKeseluruhan = ZIChecklist::where('status', 'Terisi')->whereNotNull('petugas_id')->count();
        $persentaseKeseluruhan = ($totalTugasKeseluruhan > 0) ? ($tugasSelesaiKeseluruhan / $totalTugasKeseluruhan) * 100 : 0;
        
        $overallStats = (object) [
            'total_tugas' => $totalTugasKeseluruhan,
            'tugas_selesai' => $tugasSelesaiKeseluruhan,
            'persentase' => round($persentaseKeseluruhan),
            'last_sync' => ZIChecklist::max('updated_at'), // Ambil waktu update terakhir
        ];

        return view('livewire.pcl-monitoring', [
            'statistikPetugas' => $statistikPetugas,
            'overallStats' => $overallStats,
        ])->layout('layouts.public'); // Gunakan layout publik (guest)
    }
}
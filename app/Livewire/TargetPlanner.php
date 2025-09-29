<?php

namespace App\Livewire;

use App\Models\TargetMingguan;
use App\Models\ZIChecklist;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Filament\Notifications\Notification;

class TargetPlanner extends Component
{
    public int $selectedYear;
    public int $selectedMonth;
    public array $years = [];
    public Carbon $currentDate;

    // Menyimpan data target asli dari database
    public array $originalTargets = [];
    // Menyimpan perubahan yang belum disimpan (state lokal)
    public array $dirtyTargets = [];

    public function mount()
    {
        $this->years = TargetMingguan::select('tahun')->distinct()->orderBy('tahun', 'desc')->pluck('tahun')->toArray();
        if (empty($this->years)) {
            $this->years[] = now()->year;
        }

        $this->selectedYear = now()->year;
        $this->selectedMonth = now()->month;
        $this->currentDate = Carbon::create($this->selectedYear, $this->selectedMonth, 1);
        
        $this->loadTargets();
    }

    public function loadTargets()
    {
        $targetData = TargetMingguan::where('tahun', $this->selectedYear)
            ->where('bulan', $this->selectedMonth)
            ->get();
        
        // Reset state
        $this->originalTargets = [];
        $this->dirtyTargets = [];
        foreach ($targetData as $target) {
            $this->originalTargets[$target->pertanyaan_id][$target->minggu] = $target->status;
        }
    }
    
    // Dipanggil saat filter tahun diubah
    public function updatedSelectedYear()
    {
        $this->currentDate->setYear($this->selectedYear);
        $this->loadTargets(); // Muat data baru untuk tahun yang dipilih
    }

    // Metode ini akan otomatis terpanggil setiap kali dropdown bulan diubah
    public function updatedSelectedMonth($value)
    {
        // Peringatkan pengguna jika ada perubahan yang belum disimpan
        if (!empty($this->dirtyTargets)) {
            Notification::make()
                ->title('Perubahan Belum Disimpan')
                ->body('Simpan atau batalkan perubahan Anda sebelum berpindah bulan.')
                ->warning()
                ->send();
            
            // Penting: Kembalikan pilihan dropdown ke bulan semula untuk mencegah navigasi
            $this->selectedMonth = $this->currentDate->month;
            return;
        }

        // Jika aman, lanjutkan navigasi
        $this->currentDate->setMonth($value);
        $this->loadTargets();
    }
    
    // Mengupdate state lokal, BUKAN database
    public function updateTarget(int $pertanyaanId, int $minggu)
    {
        // Tentukan status saat ini, utamakan dari dirty state jika ada
        $currentStatus = $this->dirtyTargets[$pertanyaanId][$minggu] ?? $this->originalTargets[$pertanyaanId][$minggu] ?? null;

        $nextStatus = match ($currentStatus) {
            null => 0,
            0 => 1,
            1 => null,
            default => null,
        };

        // Simpan perubahan ke array dirtyTargets
        $this->dirtyTargets[$pertanyaanId][$minggu] = $nextStatus;
    }
    
    // Metode baru untuk menyimpan semua perubahan
    public function saveChanges()
    {
        if (empty($this->dirtyTargets)) {
            Notification::make()->title('Tidak ada perubahan untuk disimpan.')->info()->send();
            return;
        }

        foreach ($this->dirtyTargets as $pertanyaanId => $minggus) {
            foreach ($minggus as $minggu => $status) {
                TargetMingguan::where('tahun', $this->selectedYear)
                    ->where('bulan', $this->selectedMonth)
                    ->where('pertanyaan_id', $pertanyaanId)
                    ->where('minggu', $minggu)
                    ->update(['status' => $status]);
            }
        }
        
        // Kirim notifikasi sukses
        Notification::make()
            ->title('Perubahan Berhasil Disimpan!')
            ->success()
            ->send();

        // Muat ulang data dari database untuk menyinkronkan state
        $this->loadTargets();
    }

    /**
     * BARU: Metode untuk membatalkan semua perubahan yang belum disimpan.
     */
    public function cancelChanges()
    {
        // Cukup dengan mereset array dirtyTargets kembali ke kondisi kosong.
        $this->dirtyTargets = [];

        // Kirim notifikasi untuk memberitahu pengguna.
        Notification::make()
            ->title('Perubahan Dibatalkan')
            ->body('Semua perubahan yang belum disimpan telah dikembalikan.')
            ->info()
            ->send();
    }

    public function render()
    {
        $this->selectedMonth = $this->currentDate->month;
        
        $pertanyaanGrouped = ZIChecklist::orderBy('aspek')
        ->orderBy('area')
        ->orderBy('pilar')
        ->orderBy('sub_pilar')
        ->orderBy('pertanyaan')
        ->get()
        ->groupBy(['aspek', 'area', 'pilar', 'sub_pilar']);

        return view('livewire.target-planner', [
            'pertanyaanGrouped' => $pertanyaanGrouped,
        ])->layout('layouts.app');
    }
}
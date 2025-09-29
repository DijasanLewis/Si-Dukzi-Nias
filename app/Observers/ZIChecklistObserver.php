<?php

namespace App\Observers;

use App\Models\TargetMingguan;
use App\Models\ZIChecklist;
use Illuminate\Support\Carbon;

class ZIChecklistObserver
{
    /**
     * Handle the ZIChecklist "created" event.
     */
    public function created(ZIChecklist $zIChecklist): void
    {
        $tahunSekarang = Carbon::now()->year;
        $dataToInsert = [];

        // Generate data untuk 12 bulan dan 4 minggu
        for ($bulan = 1; $bulan <= 12; $bulan++) {
            for ($minggu = 1; $minggu <= 4; $minggu++) {
                $dataToInsert[] = [
                    'pertanyaan_id' => $zIChecklist->id,
                    'tahun' => $tahunSekarang,
                    'bulan' => $bulan,
                    'minggu' => $minggu,
                    'status' => null, // Default status
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        // Gunakan insert untuk efisiensi (hanya 1 query)
        if (!empty($dataToInsert)) {
            TargetMingguan::insert($dataToInsert);
        }
    }

    /**
     * Handle the ZIChecklist "updated" event.
     */
    public function updated(ZIChecklist $zIChecklist): void
    {
        //
    }

    /**
     * Handle the ZIChecklist "deleted" event.
     */
    public function deleted(ZIChecklist $zIChecklist): void
    {
        //
    }

    /**
     * Handle the ZIChecklist "restored" event.
     */
    public function restored(ZIChecklist $zIChecklist): void
    {
        //
    }

    /**
     * Handle the ZIChecklist "force deleted" event.
     */
    public function forceDeleted(ZIChecklist $zIChecklist): void
    {
        //
    }
}

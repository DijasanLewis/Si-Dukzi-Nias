<?php

namespace App\Console\Commands;

use App\Models\TargetMingguan;
use App\Models\ZIChecklist;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class SyncWeeklyTargets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sync-weekly-targets {--year=} {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate target mingguan untuk tahun baru dan memastikan kelengkapan data.';


    /**
     * Execute the console command.
     */
    public function handle()
    {
        $year = $this->option('year') ?? Carbon::now()->year;
        $this->info("Memulai sinkronisasi target mingguan untuk tahun {$year}...");

        $pertanyaanIds = ZIChecklist::pluck('id');
        if ($pertanyaanIds->isEmpty()) {
            $this->warn('Tidak ada data pertanyaan (ZIChecklist) ditemukan. Proses dihentikan.');
            return;
        }

        $totalExpected = $pertanyaanIds->count() * 12 * 4;
        $this->info("Total pertanyaan: {$pertanyaanIds->count()}. Total entri yang diharapkan per tahun: {$totalExpected}.");

        $dataToUpsert = [];

        foreach ($pertanyaanIds as $pertanyaanId) {
            for ($bulan = 1; $bulan <= 12; $bulan++) {
                for ($minggu = 1; $minggu <= 4; $minggu++) {
                    $dataToUpsert[] = [
                        'pertanyaan_id' => $pertanyaanId,
                        'tahun' => $year,
                        'bulan' => $bulan,
                        'minggu' => $minggu,
                    ];
                }
            }
        }

        // Menggunakan upsert untuk efisiensi:
        // - Jika data sudah ada, tidak akan diubah (karena kita tidak memberikan nilai 'status').
        // - Jika data belum ada, akan dibuat dengan 'status' default (null).
        $createdCount = TargetMingguan::upsert(
            $dataToUpsert,
            ['pertanyaan_id', 'tahun', 'bulan', 'minggu'], // Kolom unik untuk dicek
            [] // Kolom yang di-update jika ada, kosongkan agar tidak update apa-apa
        );

        if ($createdCount > 0) {
            $this->info("Berhasil membuat {$createdCount} entri target mingguan baru.");
        } else {
            $this->info("Semua data target mingguan untuk tahun {$year} sudah lengkap.");
        }

        $this->info("Sinkronisasi selesai.");
        return self::SUCCESS;
    }
}

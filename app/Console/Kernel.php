<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Tentukan jadwal untuk perintah-perintah aplikasi.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule): void
    {
        // 1. Jalankan sinkronisasi status folder setiap hari pada jam 2 pagi.
        // Ini akan memperbarui status "Kosong" / "Terisi".
        // $schedule->command('sync:drivestatus')->dailyAt('02:00');

        // 2. Jalankan caching daftar file setiap jam.
        // Ini akan mengambil daftar file dari folder yang statusnya sudah "Terisi".
        // $schedule->command('cache:drivefiles')->hourly();
    }

    /**
     * Daftarkan perintah untuk aplikasi.
     *
     * @return void
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}

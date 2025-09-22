<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ZIChecklist;
use Illuminate\Support\Facades\Config;

class MigrateChecklistData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:migrate-checklist-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate ZI checklist data from config file to the database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Memulai checklist data migration...');

        // Ambil data dari config
        $checklists = Config::get('zi_checklist.data');

        foreach ($checklists as $item) {
            // Gunakan updateOrCreate untuk menghindari duplikasi jika command dijalankan lagi
            ZIChecklist::updateOrCreate(
                [
                    'pertanyaan' => $item['pertanyaan'] // Asumsikan 'pertanyaan' unik
                ],
                [
                    'aspek' => $item['aspek'],
                    'area' => $item['area'],
                    'pilar' => $item['pilar'],
                    'sub_pilar' => $item['sub_pilar'],
                    'rencana_aksi' => $item['rencana_aksi'],
                    'petugas_id'=> $item['petugas_id'] ?? NULL,
                ]
            );
        }
        $this->info('Checklist data migration completed successfully!');
        return 0;
    }
}

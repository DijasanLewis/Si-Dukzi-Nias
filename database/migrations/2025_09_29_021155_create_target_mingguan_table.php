<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('target_mingguan', function (Blueprint $table) {
            $table->id();
            // Menghubungkan ke tabel pertanyaan (z_i_checklists)
            $table->foreignId('pertanyaan_id')->constrained('z_i_checklists')->onDelete('cascade');
            $table->year('tahun');
            $table->tinyInteger('bulan'); // 1-12
            $table->tinyInteger('minggu'); // 1-4
            
            // null: tidak ada target
            // 0: ada target, belum tercapai
            // 1: ada target, sudah tercapai
            $table->tinyInteger('status')->nullable();

            $table->timestamps();

            // Menambahkan index untuk performa query yang lebih cepat
            $table->index(['tahun', 'bulan', 'minggu']);
            // Menambahkan unique constraint agar tidak ada data duplikat
            $table->unique(['pertanyaan_id', 'tahun', 'bulan', 'minggu']);
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('target_mingguan');
    }
};

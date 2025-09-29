<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('target_mingguan', function (Blueprint $table) {
            // Memberi nama pada constraint agar mudah di-rollback
            $table->unique(['pertanyaan_id', 'tahun', 'bulan', 'minggu'], 'target_mingguan_unique_constraint');
        });
    }

    public function down(): void
    {
        Schema::table('target_mingguan', function (Blueprint $table) {
            $table->dropUnique('target_mingguan_unique_constraint');
        });
    }
};
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
        Schema::table('z_i_checklists', function (Blueprint $table) {
            $table->text('rencana_aksi')->nullable()->after('pertanyaan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('z_i_checklists', function (Blueprint $table) {
            $table->dropColumn('rencana_aksi');
        });
    }
};

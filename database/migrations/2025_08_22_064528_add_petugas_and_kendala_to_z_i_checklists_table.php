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
            $table->foreignId('petugas_id')->nullable()->constrained('petugas')->onDelete('set null');
            $table->text('kendala')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('z_i_checklists', function (Blueprint $table) {
            $table->dropForeign(['petugas_id']);
            $table->dropColumn(['petugas_id', 'kendala']);
        });
    }
};

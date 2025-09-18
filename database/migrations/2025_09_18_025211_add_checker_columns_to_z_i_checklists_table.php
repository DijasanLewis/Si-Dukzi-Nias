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
            // Tambahkan kolom 'status_pemeriksa' sebagai ENUM
            $table->enum('status_pemeriksa', ['Sudah Lengkap', 'Belum Lengkap'])->nullable()->after('kendala_updated_at');

            // Tambahkan kolom 'catatan_pemeriksa' sebagai TEXT
            $table->text('catatan_pemeriksa')->nullable()->after('status_pemeriksa');

            // Tambahkan kolom 'timestamp_catatan_pemeriksa' sebagai timestamp
            $table->timestamp('timestamp_catatan_pemeriksa')->nullable()->after('catatan_pemeriksa');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('z_i_checklists', function (Blueprint $table) {
            // Hapus kolom jika migrasi dibatalkan
            $table->dropColumn(['status_pemeriksa', 'catatan_pemeriksa', 'timestamp_catatan_pemeriksa']);
        });
    }
};

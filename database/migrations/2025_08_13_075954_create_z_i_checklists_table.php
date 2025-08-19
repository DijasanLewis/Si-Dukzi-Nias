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
        Schema::create('z_i_checklists', function (Blueprint $table) {
            $table->id();
            $table->string('aspek');
            $table->string('area');
            $table->string('pilar');
            $table->string('sub_pilar')->nullable();
            $table->text('pertanyaan'); // Kolom yang dibutuhkan
            $table->string('google_drive_folder_id')->nullable();
            $table->enum('status', ['Kosong', 'Terisi'])->default('Kosong');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('z_i_checklists');
    }
};
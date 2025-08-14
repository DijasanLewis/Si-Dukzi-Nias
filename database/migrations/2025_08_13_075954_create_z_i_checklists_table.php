<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void{
        Schema::create('z_i_checklists', function (Blueprint $table) { 
            $table->id();        
            $table->string('area_perubahan');        
            $table->text('poin_penilaian');        
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

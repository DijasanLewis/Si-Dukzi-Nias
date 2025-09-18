<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ZIChecklist extends Model
{
    use HasFactory;

    // Ganti nama tabel jika tidak sesuai standar Laravel (opsional, tapi disarankan)
    protected $table = 'z_i_checklists';

    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'aspek',
        'area',
        'pilar',
        'sub_pilar',
        'pertanyaan',
        'rencana_aksi',
        'google_drive_folder_id',
        'status',
        'petugas_id',
        'kendala',
        'kendala_updated_at'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        // Memberitahu Laravel untuk memperlakukan kolom ini sebagai objek Carbon (Tanggal & Waktu)
        'kendala_updated_at' => 'datetime', 
    ];

    public function petugas(): BelongsTo
    {
        return $this->belongsTo(Petugas::class);
    }
}
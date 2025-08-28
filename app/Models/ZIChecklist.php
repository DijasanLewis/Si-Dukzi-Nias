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
        'google_drive_folder_id',
        'status',
        'petugas_id',
        'kendala'
    ];

    public function petugas(): BelongsTo
    {
        return $this->belongsTo(Petugas::class);
    }
}
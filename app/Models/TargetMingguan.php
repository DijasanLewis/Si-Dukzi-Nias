<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TargetMingguan extends Model
{
    use HasFactory;

    protected $table = 'target_mingguan';

    protected $fillable = [
        'pertanyaan_id',
        'tahun',
        'bulan',
        'minggu',
        'status',
    ];

    /**
     * Mendefinisikan relasi ke model ZIChecklist.
     */
    public function ziChecklist(): BelongsTo
    {
        return $this->belongsTo(ZIChecklist::class, 'pertanyaan_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SantriDikeluarkan extends Model
{
    use HasFactory;
    protected $table = "santri_dikeluarkan";
    protected $fillable = [
        'santri_id',
        'kelas_sebelum_id',
        'tanggal_dikeluarkan',
        'alasan_dikeluarkan',
        'file_pendukung',
    ];
    // Relasi ke model Santri
    public function santri()
    {
        return $this->belongsTo(Santri::class, 'santri_id');
    }

    // Relasi ke model Kelas
    public function kelasSebelum()
    {
        return $this->belongsTo(Kelas::class, 'kelas_sebelum_id');
    }
}

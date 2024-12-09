<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PindahSekolah extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'pindah_sekolah';

    // Field yang dapat diisi
    protected $fillable = [
        'santri_id',
        'kelas_sebelum_id',
        'sekolah_tujuan',
        'tanggal_pindah',
        'alasan_pindah',
    ];

    // Relasi ke tabel Santri
    public function santri()
    {
        return $this->belongsTo(Santri::class, 'santri_id');
    }

    // Relasi ke tabel Kelas
    public function kelasSebelum()
    {
        return $this->belongsTo(Kelas::class, 'kelas_sebelum_id');
    }
}

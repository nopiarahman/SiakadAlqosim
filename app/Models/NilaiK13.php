<?php

namespace App\Models;

use App\Models\KDK13;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NilaiK13 extends Model
{
    use HasFactory;
    protected $table = "nilai_k13";
    protected $guarded =['id','created_at','updated_at'];

    /**
     * Get the jadwal that owns the Nilai
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function jadwal(): BelongsTo
    {
        return $this->belongsTo(Jadwal::class);
    }
    /**
     * Get the mapel that owns the NilaiK13
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function mapel(): BelongsTo
    {
        return $this->belongsTo(Mapel::class);
    }
    public function hitungNilaiAkhir()
    {
        // Menghitung rata-rata nilai H yang tidak null
        $nilaiH = array_filter([$this->h1, $this->h2, $this->h3, $this->h4, $this->h5, $this->h6, $this->h7, $this->h8], function ($nilai) {
            return $nilai !== null;
        });

        // Menghitung nilai akhir sesuai rumus
        $rataRataH = empty($nilaiH) ? 0 : array_sum($nilaiH) / count($nilaiH);
        $PTS = $this->PTS ?? 0;
        $PAS = $this->PAS ?? 0;

        $nilaiAkhir = (2 * $rataRataH + $PTS + $PAS) / 4;

        return round($nilaiAkhir,0,PHP_ROUND_HALF_UP);
    }
    public function getPredikatNilai()
    {
        $nilaiAkhir = $this->hitungNilaiAkhir();

        if ($nilaiAkhir <= 60) {
            return 'K';
        } elseif ($nilaiAkhir <= 70) {
            return 'C';
        } elseif ($nilaiAkhir <= 84) {
            return 'B';
        } elseif ($nilaiAkhir <= 100) {
            return 'A';
        } else {
            return 'Nilai tidak valid';
        }
    }
    public function getDeskripsiKD()
    {
        // Ambil nilai-nilai h dari tabel NilaiK13 dan kelompokkan berdasarkan KD
        $data = $this->select('h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'h7', 'h8')
        ->first()->toArray();

        // Hapus nilai null dari array
        $hValues = array_filter($data, fn($value) => $value !== null);

        $kunciTertinggi = array_search(max($hValues), $hValues);
        $kunciTerendah = array_search(min($hValues), $hValues);
        
        $kd = KDK13::where('mapel_id', $this->mapel_id)
        ->where('kelas_id',$this->kelas_id)
        ->where('periode_id',$this->periode_id)
        ->first();
        if ($kd) {
            $deskripsiTerbesar = $kd->getDeskripsiKDByNilai($kunciTertinggi);
            $deskripsiTerkecil = $kd->getDeskripsiKDByNilai($kunciTerendah);
            
            $deskripsi = 'Alhamdulillah ananda '.$this->getPredikatKD($data[$kunciTertinggi]).' dalam '.$deskripsiTerbesar.' dan '.$this->getPredikatKD($data[$kunciTerendah]).' dalam '.$deskripsiTerkecil;
            return $deskripsi;
        } else {
            return 'Data KD atau Nilai tidak ditemukan'; // Atau nilai default lain sesuai kebutuhan Anda
        }
    }
    public function getPredikatKD($nilai){
        if ($nilai <= 60) {
            return 'perlu dimaksimalkan';
        } elseif ($nilai <= 70) {
            return 'cukup';
        } elseif ($nilai <= 84) {
            return 'baik';
        } elseif ($nilai <= 100) {
            return 'sangat baik';
        } else {
            return 'Nilai tidak valid';
        }
    }
}

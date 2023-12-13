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
    public function hitungNilaiAkhirKeterampilan()
    {
        // Menghitung rata-rata nilai H yang tidak null
        $nilaiK = array_filter([$this->k1, $this->k2, $this->k3, $this->k4, $this->k5, $this->k6, $this->k7, $this->k8], function ($nilai) {
            return $nilai !== null;
        });
        // Menghitung nilai akhir sesuai rumus
        $rataRataK = empty($nilaiK) ? 0 : array_sum($nilaiK) / count($nilaiK);

        return round($rataRataK,0,PHP_ROUND_HALF_UP);
    }
    public function getPredikatNilai()
    {
        $nilaiAkhir = $this->hitungNilaiAkhir();

        if ($nilaiAkhir <= 57) {
            return 'K';
        } elseif ($nilaiAkhir <= 66) {
            return 'E';
        }elseif ($nilaiAkhir <= 74) {
            return 'D';
        } elseif ($nilaiAkhir <= 83) {
            return 'C';
        } elseif ($nilaiAkhir <= 91) {
            return 'B';
        } elseif ($nilaiAkhir <= 100) {
            return 'A';
        } else {
            return 'Nilai tidak valid';
        }
    }
    public function getPredikatNilaiKeterampilan()
    {
        $nilaiAkhir = $this->hitungNilaiAkhirKeterampilan();

        if ($nilaiAkhir <= 57) {
            return 'K';
        } elseif ($nilaiAkhir <= 66) {
            return 'E';
        }elseif ($nilaiAkhir <= 74) {
            return 'D';
        } elseif ($nilaiAkhir <= 83) {
            return 'C';
        } elseif ($nilaiAkhir <= 91) {
            return 'B';
        } elseif ($nilaiAkhir <= 100) {
            return 'A';
        } else {
            return 'Nilai tidak valid';
        }
    }
    public function countNonNullValuesH()
    {
        $attributes = ['h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'h7', 'h8'];
        
        return count(array_filter($this->only($attributes), function($value) {
            return !is_null($value);
        }));
    }
    public function countNonNullValuesK()
    {
        $attributes = ['k1', 'k2', 'k3', 'k4', 'k5', 'k6', 'k7', 'k8'];
        
        return count(array_filter($this->only($attributes), function($value) {
            return !is_null($value);
        }));
    }
    public function keyOfHighestValueH()
    {
        $attributes = ['h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'h7', 'h8'];
        $highestKey = null;
        $highestValue = null;

        foreach ($attributes as $attribute) {
            $value = $this->$attribute;
            if (!is_null($value) && ($highestValue === null || $value > $highestValue)) {
                $highestValue = $value;
                $highestKey = $attribute;
            }
        }

        return $highestKey;
    }
    public function keyOfLowestValueH()
    {
        $attributes = ['h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'h7', 'h8'];
        $lowestKey = null;
        $lowestValue = null;

        foreach ($attributes as $attribute) {
            $value = $this->$attribute;
            if (!is_null($value) && ($lowestValue === null || $value < $lowestValue)) {
                $lowestValue = $value;
                $lowestKey = $attribute;
            }
        }

        return $lowestKey;
    }
    public function keyOfHighestValueK()
    {
        $attributes = ['k1', 'k2', 'k3', 'k4', 'k5', 'k6', 'k7', 'k8'];
        $highestKey = null;
        $highestValue = null;

        foreach ($attributes as $attribute) {
            $value = $this->$attribute;
            if (!is_null($value) && ($highestValue === null || $value > $highestValue)) {
                $highestValue = $value;
                $highestKey = $attribute;
            }
        }

        return $highestKey;
    }
    public function keyOfLowestValueK()
    {
        $attributes = ['k1', 'k2', 'k3', 'k4', 'k5', 'k6', 'k7', 'k8'];
        $lowestKey = null;
        $lowestValue = null;

        foreach ($attributes as $attribute) {
            $value = $this->$attribute;
            if (!is_null($value) && ($lowestValue === null || $value < $lowestValue)) {
                $lowestValue = $value;
                $lowestKey = $attribute;
            }
        }

        return $lowestKey;
    }
    public function getDeskripsiKD()
    {
        $kd = KDK13::where('mapel_id', $this->mapel_id)
        ->where('kelas_id',$this->kelas_id)
        ->where('periode_id',$this->periode_id)
        ->first();
        // dd($kd);
        if ($kd) {
            $deskripsiTerbesar = $kd->getDeskripsiKDByNilai($this->keyOfHighestValueH());
            $deskripsiTerkecil = $kd->getDeskripsiKDByNilai($this->keyOfLowestValueH());
            if($this->countNonNullValuesH()>1){
                $deskripsi = 'Alhamdulillah ananda '.$this->getPredikatKD($this[$this->keyOfHighestValueH()]).' dalam '.$deskripsiTerbesar.' dan '.$this->getPredikatKD($this[$this->keyOfLowestValueH()]).' dalam '.$deskripsiTerkecil;
            }else{
                $deskripsi = 'Alhamdulillah ananda '.$this->getPredikatKD($this[$this->keyOfHighestValueH()]).' dalam '.$deskripsiTerbesar;
            }
            return $deskripsi;
        } else {
            return 'Data KD atau Nilai tidak ditemukan'; // Atau nilai default lain sesuai kebutuhan Anda
        }
    }
    public function getDeskripsiKDKeterampilan()
    {
        $kd = KDK13::where('mapel_id', $this->mapel_id)
        ->where('kelas_id',$this->kelas_id)
        ->where('periode_id',$this->periode_id)
        ->first();
        if ($kd) {
            $deskripsiTerbesar = $kd->getDeskripsiKDByNilai($this->keyOfHighestValueK());
            $deskripsiTerkecil = $kd->getDeskripsiKDByNilai($this->keyOfLowestValueK());
            if($this->countNonNullValuesK()>1){
                $deskripsi = 'Alhamdulillah ananda '.$this->getPredikatKD($this[$this->keyOfHighestValueK()]).' dalam '.$deskripsiTerbesar.' dan '.$this->getPredikatKD($this[$this->keyOfLowestValueK()]).' dalam '.$deskripsiTerkecil;
            }else{
                $deskripsi = 'Alhamdulillah ananda '.$this->getPredikatKD($this[$this->keyOfHighestValueK()]).' dalam '.$deskripsiTerbesar;
            }
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

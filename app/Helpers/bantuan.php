<?php

use App\Models\Periode;
use App\Models\NilaiK13;
use App\Models\DataRaportK13;

function getPeriodeAktif() {
    $periode = Periode::where('status','aktif')->first();
    return $periode;
}
function nilaiSantriHarianK13($santriId,$kelasId,$mapelId,$periodeId,$kurikulumId,$key) {
    $nilai = NilaiK13::where('santri_id',$santriId)
                        ->where('kelas_id',$kelasId)
                        ->where('mapel_id',$mapelId)
                        ->where('periode_id',$periodeId)
                        ->first();
    if ($nilai) {
        return $nilai->$key;
    }
    return "";
}
function nilaiSantriPTSK13($santriId,$kelasId,$mapelId,$periodeId,) {
    $nilai = NilaiK13::where('santri_id',$santriId)
                        ->where('kelas_id',$kelasId)
                        ->where('mapel_id',$mapelId)
                        ->where('periode_id',$periodeId)
                        ->first();
    if ($nilai) {
        return $nilai->PTS;
    }
    return "";
}
function nilaiSantriPASK13($santriId,$kelasId,$mapelId,$periodeId) {
    $nilai = NilaiK13::where('santri_id',$santriId)
                        ->where('kelas_id',$kelasId)
                        ->where('mapel_id',$mapelId)
                        ->where('periode_id',$periodeId)
                        ->first();
    if ($nilai) {
        return $nilai->PAS;
    }
    return "";
}
function nilaiRPH($santriId,$kelasId,$mapelId,$periodeId,$kurikulumId) {
    $nilai = NilaiK13::where('santri_id',$santriId)
            ->where('kelas_id',$kelasId)
            ->where('mapel_id',$mapelId)
            ->where('periode_id',$periodeId)
            ->where('kurikulum_id',$kurikulumId)
            ->first();
            if ($nilai) {
                $nilaiH = collect([
                    $nilai->h1,
                    $nilai->h2,
                    $nilai->h3,
                    $nilai->h4,
                    $nilai->h5,
                    $nilai->h6,
                    $nilai->h7,
                    $nilai->h8,
                ])->filter(function ($nilai) {
                    return $nilai !== null;
                });
                
                // Menghitung rata-rata
                $rataRata = $nilaiH->avg();
                return $rataRata;                
            }
            return "";
}
function nilaiRPHKeterampilan($santriId,$kelasId,$mapelId,$periodeId,$kurikulumId) {
    $nilai = NilaiK13::where('santri_id',$santriId)
            ->where('kelas_id',$kelasId)
            ->where('mapel_id',$mapelId)
            ->where('periode_id',$periodeId)
            ->where('kurikulum_id',$kurikulumId)
            ->first();
            if ($nilai) {
                $nilaiH = collect([
                    $nilai->k1,
                    $nilai->k2,
                    $nilai->k3,
                    $nilai->k4,
                    $nilai->k5,
                    $nilai->k6,
                    $nilai->k7,
                    $nilai->k8,
                ])->filter(function ($nilai) {
                    return $nilai !== null;
                });
                
                // Menghitung rata-rata
                $rataRata = $nilaiH->avg();
                return $rataRata;                
            }
            return "";
}
function nilaiRaport($jadwal,$santri_id) {
    $nilai = $jadwal->nilai->where('santri_id',$santri_id)->first();
    $nilaiAkhir = 0;
    if($nilai){
        $nilaiAkhir=($nilai->uas*30)/100+($nilai->akhlak*30)/100+($nilai->uts*20)/100+($nilai->harian*20)/100;
    }
    return $nilaiAkhir;
}
function rataRataKelas($jadwal) {
    $nilai= $jadwal->nilai;
    $rataRata = [];
    foreach ($nilai as $i) {
        $rataRata[]=($i->uas*30)/100+($i->akhlak*30)/100+($i->uts*20)/100+($i->harian*20)/100;
    }
    if (count($rataRata)) {
        $rataRataKelas = array_sum($rataRata)/count($rataRata);
    }else{
        $rataRataKelas = 0;
    }
    return round($rataRataKelas,2);
}
function absensi(string $key,$santriId,$periodeId) {
    $absensi = DataRaportK13::where('santri_id',$santriId)->where('periode_id',$periodeId)->first();

    if($absensi){
        return $absensi->$key;
    }
    return "";
}
function catatanWaliKelas($santriId,$periodeId) {
    $absensi = DataRaportK13::where('santri_id',$santriId)->where('periode_id',$periodeId)->first();

    if($absensi){
        return $absensi->catatan;
    }
    return "";
}
function sikapWaliKelas($santriId,$periodeId,$key) {
    $data = DataRaportK13::where('santri_id',$santriId)->where('periode_id',$periodeId)->first();

    if($data){
        return $data->sikap->first()->$key;
    }
    return "";
}
function getNilaiPSantri($santri, $kelas, $mapel) {
    $nilaiP=NilaiK13::where('santri_id',$santri)
    ->where('kelas_id',$kelas)
    ->where('mapel_id',$mapel)
    ->where('periode_id',getPeriodeAktif()->id)
    ->first();
    if($nilaiP){
        return $nilaiP->hitungNilaiAkhir();
    }return 0;
}
function getNilaiKSantri($santri, $kelas, $mapel) {
    $nilaiP=NilaiK13::where('santri_id',$santri)
    ->where('kelas_id',$kelas)
    ->where('mapel_id',$mapel)
    ->where('periode_id',getPeriodeAktif()->id)
    ->first();
    if($nilaiP){
        return $nilaiP->hitungNilaiAkhirKeterampilan();
    }return 0;
}

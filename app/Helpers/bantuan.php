<?php

use App\Models\Periode;

function getPeriodeAktif() {
    $periode = Periode::where('status','aktif')->first();
    return $periode;
}
function nilaiHarianSantri($jadwal,$santri_id) {
    $nilai = $jadwal->nilai->where('santri_id',$santri_id)->first();
    if ($nilai) {
        if($nilai->harian){
            return $nilai->harian;
        }
    }
    return 0;
}
function nilaiUtsSantri($jadwal,$santri_id) {
    $nilai = $jadwal->nilai->where('santri_id',$santri_id)->first();
    if ($nilai) {
        if($nilai->uts){
            return $nilai->uts;
        }
    }
    return 0;
}
function nilaiUasSantri($jadwal,$santri_id) {
    $nilai = $jadwal->nilai->where('santri_id',$santri_id)->first();
    if ($nilai) {
        if($nilai->uas){
            return $nilai->uas;
        }
    }
    return 0;
}
function nilaiAkhlakSantri($jadwal,$santri_id) {
    $nilai = $jadwal->nilai->where('santri_id',$santri_id)->first();
    if ($nilai) {
        if($nilai->akhlak){
            return $nilai->akhlak;
        }
    }
    return 0;
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

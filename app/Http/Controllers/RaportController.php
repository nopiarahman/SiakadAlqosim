<?php

namespace App\Http\Controllers;

use App\Models\Santri;
use App\Models\NilaiK13;
use Illuminate\Http\Request;

class RaportController extends Controller
{
    function semesterk13(Santri $santri, $kelas) {
        $nilaiPengetahuan = NilaiK13::select('id', 'mapel_id','PTS','PAS', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'h7', 'h8','kelas_id','periode_id')
        ->where('santri_id',$santri->id)
        ->where('kelas_id',$kelas)
        ->where('periode_id',getPeriodeAktif()->id)
        ->get();
        $nilaiKeterampilan = NilaiK13::select('id', 'mapel_id', 'k1', 'k2', 'k3', 'k4', 'k5', 'k6', 'k7', 'k8')
        ->where('santri_id',$santri->id)
        ->where('kelas_id',$kelas)
        ->where('periode_id',getPeriodeAktif()->id)
        ->get();
        return view('raport.pas',compact('santri','nilaiPengetahuan','nilaiKeterampilan'));
    }
}

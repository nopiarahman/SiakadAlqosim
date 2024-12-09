<?php

namespace App\Http\Controllers;

use App\Models\Santri;
use App\Models\NilaiK13;
use Illuminate\Http\Request;
use App\Models\DataRaportK13;

class RaportController extends Controller
{
    function semesterk13(Santri $santri, $kelas) {
        $nilaiPengetahuanAll = NilaiK13::select('id', 'mapel_id','PTS','PAS', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'h7', 'h8','kelas_id','periode_id')
        ->where('santri_id',$santri->id)
        ->where('kelas_id',$kelas)
        ->where('periode_id',getPeriodeAktif()->id)
        ->get();
        $nilaiKeterampilanAll = NilaiK13::select('id', 'mapel_id', 'k1', 'k2', 'k3', 'k4', 'k5', 'k6', 'k7', 'k8','kelas_id','periode_id')
        ->where('santri_id',$santri->id)
        ->where('kelas_id',$kelas)
        ->where('periode_id',getPeriodeAktif()->id)
        ->get();
        $nilaiPengetahuan = $nilaiPengetahuanAll->sortBy(function ($nilaiK13) {
            return $nilaiK13->mapel ? $nilaiK13->mapel->nama : ''; // Ganti nama dengan string kosong jika mapel null
        });
        $nilaiKeterampilan = $nilaiKeterampilanAll->sortBy(function ($nilaiK13) {
            return $nilaiK13->mapel ? $nilaiK13->mapel->nama : ''; // Ganti nama dengan string kosong jika mapel null
        });
        // $nilaiPengetahuan = $nilaiPengetahuanAll->sortBy(function ($nilaiK13) {
        //     return $nilaiK13->mapel->nama;
        // });
        // $nilaiKeterampilan = $nilaiKeterampilanAll->sortBy(function ($nilaiK13) {
        //     return $nilaiK13->mapel->nama;
        // });
        $dataRaport=DataRaportK13::where('santri_id',$santri->id)->where('periode_id',getPeriodeAktif()->id)->first();
        // dd($dataRaport);
        return view('raport.pas',compact('santri','nilaiPengetahuan','nilaiKeterampilan','dataRaport'));
    }
    public function printPasK13(Santri $santri, $kelas)
    {
        $nilaiPengetahuan = NilaiK13::select('id', 'mapel_id','PTS','PAS', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'h7', 'h8','kelas_id','periode_id')
        ->where('santri_id',$santri->id)
        ->where('kelas_id',$kelas)
        ->where('periode_id',getPeriodeAktif()->id)
        ->get();
        $nilaiKeterampilan = NilaiK13::select('id', 'mapel_id', 'k1', 'k2', 'k3', 'k4', 'k5', 'k6', 'k7', 'k8','kelas_id','periode_id')
        ->where('santri_id',$santri->id)
        ->where('kelas_id',$kelas)
        ->where('periode_id',getPeriodeAktif()->id)
        ->get();
        $dataRaport=DataRaportK13::where('santri_id',$santri->id)->where('periode_id',getPeriodeAktif()->id)->first();
        return view('raport.pasPrint',compact('santri','nilaiPengetahuan','nilaiKeterampilan','dataRaport'));
    }
}

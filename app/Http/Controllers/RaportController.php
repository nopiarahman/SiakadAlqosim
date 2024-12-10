<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Santri;
use App\Models\Periode;
use App\Models\Marhalah;
use App\Models\NilaiK13;
use Illuminate\Http\Request;
use App\Models\DataRaportK13;
use Illuminate\Support\Facades\DB;

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

    function nilaiSantri() {
        // Ambil data marhalah berdasarkan marhalah_id dari user yang sedang login
        $marhalah = Marhalah::find(auth()->user()->marhalah_id);
    
        // Ambil kelas berdasarkan marhalah_id yang sama
        $kelas = Kelas::where('marhalah_id', $marhalah->id)->get();
    
        // Cek apakah data user sudah ada di tabel temp
        $temp = DB::table('temp')->where('user_id', auth()->user()->id)->first();
    
        // Jika belum ada, buat data baru dengan user_id dan periode_id
        if (!$temp) {
            $periode_id = getPeriodeAktif()->id; // Dapatkan periode aktif
            DB::table('temp')->insert([
                'user_id' => auth()->user()->id,
                'periode_id' => $periode_id,
            ]);
            $periode = Periode::find($periode_id);; // Ambil periode baru
        } else {
            // Jika sudah ada, ambil periode yang ada di tabel temp
            $periode = Periode::find($temp->periode_id);
        }
        // Return view dengan data kelas, marhalah, dan periode yang relevan
        return view('nilaiK13.nilaiSantri', compact('kelas', 'marhalah', 'periode'));
    }
    
}

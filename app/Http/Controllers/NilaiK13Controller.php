<?php

namespace App\Http\Controllers;

use App\Models\KDK13;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Jadwal;
use App\Models\NilaiK13;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class NilaiK13Controller extends Controller
{
    function index() {
        $user = Auth::user();
        $list = Jadwal::select('mapel_id', 'kelas_id')
        ->where('guru_id', $user->guru->first()->id)
        ->where('periode_id', getPeriodeAktif()->id)
        ->groupBy('mapel_id', 'kelas_id')
        ->get();
        return view('nilaiK13.index',compact('list'));
    }
    function pengetahuan(Kelas $kelas, Mapel $mapel) {
        $santri = $kelas->santri;
        $kdPengetahuan = KDK13::select('id', 'mapel_id', 'kelas_id', 'periode_id', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'h7', 'h8')
            ->where('kelas_id',$kelas->id)->where('mapel_id',$mapel->id)
            ->get();
        return view('nilaiK13.pengetahuan',compact('santri','kelas','mapel','kdPengetahuan'));
    }
    function keterampilan(Kelas $kelas, Mapel $mapel) {
        $santri = $kelas->santri;
        $kdKeterampilan = KDK13::select('id', 'mapel_id', 'kelas_id', 'periode_id', 'k1', 'k2', 'k3', 'k4', 'k5', 'k6', 'k7', 'k8')
            ->where('kelas_id',$kelas->id)->where('mapel_id',$mapel->id)->get();
        return view('nilaiK13.keterampilan',compact('santri','kelas','mapel','kdKeterampilan'));
    }
    function pts(Kelas $kelas, Mapel $mapel) {
        $santri = $kelas->santri;
        return view('nilaiK13.pts',compact('santri','kelas','mapel'));
    }
    function pas(Kelas $kelas, Mapel $mapel) {
        $santri = $kelas->santri;
        return view('nilaiK13.pas',compact('santri','kelas','mapel'));
    }
    function store(Request $request) {
        try {
            DB::beginTransaction();
            $requestData = [
                'santri_id' => $request->santri_id,
                'mapel_id' => $request->mapel_id,  // Sesuaikan dengan mapel_id yang sesuai
                'kelas_id' => $request->kelas_id,  // Sesuaikan dengan kelas_id yang sesuai
                'periode_id' => getPeriodeAktif()->id,  // Sesuaikan dengan periode_id yang sesuai
                'kurikulum_id' => $request->kurikulum_id,  // Sesuaikan dengan kurikulum_id yang sesuai
                'h1' => $request->h1,
                'h2' => $request->h2,
                'h3' => $request->h3,
                'h4' => $request->h4,
                'h5' => $request->h5,
                'h6' => $request->h6,
                'h7' => $request->h7,
                'h8' => $request->h8,
            ];
            // Memperbarui atau membuat data berdasarkan santri_id, mapel_id, kelas_id, dan periode_id
            NilaiK13::updateOrCreate(
                ['santri_id' => $requestData['santri_id'], 'mapel_id' => $requestData['mapel_id'], 'kelas_id' => $requestData['kelas_id'], 'periode_id' => $requestData['periode_id']],
                $requestData
            );
            DB::commit();
            return redirect()->back()->with('success','Nilai Berhasil ditambahkan');
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with('error','Gagal. Pesan Error: '.$ex->getMessage());
        }
    }
    function storeKeterampilan(Request $request) {
        try {
            DB::beginTransaction();
            $requestData = [
                'santri_id' => $request->santri_id,
                'mapel_id' => $request->mapel_id,  // Sesuaikan dengan mapel_id yang sesuai
                'kelas_id' => $request->kelas_id,  // Sesuaikan dengan kelas_id yang sesuai
                'periode_id' => getPeriodeAktif()->id,  // Sesuaikan dengan periode_id yang sesuai
                'kurikulum_id' => $request->kurikulum_id,  // Sesuaikan dengan kurikulum_id yang sesuai
                'k1' => $request->k1,
                'k2' => $request->k2,
                'k3' => $request->k3,
                'k4' => $request->k4,
                'k5' => $request->k5,
                'k6' => $request->k6,
                'k7' => $request->k7,
                'k8' => $request->k8,
            ];
            // Memperbarui atau membuat data berdasarkan santri_id, mapel_id, kelas_id, dan periode_id
            NilaiK13::updateOrCreate(
                ['santri_id' => $requestData['santri_id'], 'mapel_id' => $requestData['mapel_id'], 'kelas_id' => $requestData['kelas_id'], 'periode_id' => $requestData['periode_id']],
                $requestData
            );
            DB::commit();
            return redirect()->back()->with('success','Nilai Berhasil ditambahkan');
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with('error','Gagal. Pesan Error: '.$ex->getMessage());
        }
    }
    function storePTS(Request $request) {
        try {
            DB::beginTransaction();
            $requestData = [
                'santri_id' => $request->santri_id,
                'mapel_id' => $request->mapel_id,  // Sesuaikan dengan mapel_id yang sesuai
                'kelas_id' => $request->kelas_id,  // Sesuaikan dengan kelas_id yang sesuai
                'periode_id' => getPeriodeAktif()->id,  // Sesuaikan dengan periode_id yang sesuai
                'kurikulum_id' => $request->kurikulum_id,  // Sesuaikan dengan kurikulum_id yang sesuai
                'pts' => $request->pts,
            ];
            // Memperbarui atau membuat data berdasarkan santri_id, mapel_id, kelas_id, dan periode_id
            NilaiK13::updateOrCreate(
                ['santri_id' => $requestData['santri_id'], 'mapel_id' => $requestData['mapel_id'], 'kelas_id' => $requestData['kelas_id'], 'periode_id' => $requestData['periode_id']],
                ['PTS'=>$requestData['pts']]
            );
            DB::commit();
            return redirect()->back()->with('success','Nilai PTS Berhasil ditambahkan');
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with('error','Gagal. Pesan Error: '.$ex->getMessage());
        }
    }
    function storePAS(Request $request) {
        try {
            DB::beginTransaction();
            $requestData = [
                'santri_id' => $request->santri_id,
                'mapel_id' => $request->mapel_id,  // Sesuaikan dengan mapel_id yang sesuai
                'kelas_id' => $request->kelas_id,  // Sesuaikan dengan kelas_id yang sesuai
                'periode_id' => getPeriodeAktif()->id,  // Sesuaikan dengan periode_id yang sesuai
                'kurikulum_id' => $request->kurikulum_id,  // Sesuaikan dengan kurikulum_id yang sesuai
                'pas' => $request->pas,
            ];
            // Memperbarui atau membuat data berdasarkan santri_id, mapel_id, kelas_id, dan periode_id
            NilaiK13::updateOrCreate(
                ['santri_id' => $requestData['santri_id'], 'mapel_id' => $requestData['mapel_id'], 'kelas_id' => $requestData['kelas_id'], 'periode_id' => $requestData['periode_id']],
                ['PAS'=>$requestData['pas']]
            );
            DB::commit();
            return redirect()->back()->with('success','Nilai PAS Berhasil ditambahkan');
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with('error','Gagal. Pesan Error: '.$ex->getMessage());
        }
    }
}

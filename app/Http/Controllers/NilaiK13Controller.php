<?php

namespace App\Http\Controllers;

use App\Models\KDK13;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Jadwal;
use App\Models\Santri;
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
        // Get the IDs of santri associated with the kelas
        $santriIds = $kelas->santri->pluck('id');
    
        // Query the Santri model directly, ordering by namaLengkap
        $santri = Santri::whereIn('id', $santriIds)
                        ->orderBy('namaLengkap')
                        ->get();
    
        $kdPengetahuan = KDK13::select('id', 'mapel_id', 'kelas_id', 'periode_id', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'h7', 'h8')
            ->where('kelas_id', $kelas->id)
            ->where('mapel_id', $mapel->id)
            ->get();
    
        return view('nilaiK13.pengetahuan', compact('santri', 'kelas', 'mapel', 'kdPengetahuan'));
    }
    function keterampilan(Kelas $kelas, Mapel $mapel) {
        $santriIds = $kelas->santri->pluck('id');
        $santri = Santri::whereIn('id', $santriIds)
                        ->orderBy('namaLengkap')
                        ->get();
    
        $kdKeterampilan = KDK13::select('id', 'mapel_id', 'kelas_id', 'periode_id', 'k1', 'k2', 'k3', 'k4', 'k5', 'k6', 'k7', 'k8')
            ->where('kelas_id', $kelas->id)
            ->where('mapel_id', $mapel->id)
            ->get();
    
        return view('nilaiK13.keterampilan', compact('santri', 'kelas', 'mapel', 'kdKeterampilan'));
    }
    
    function pts(Kelas $kelas, Mapel $mapel) {
        $santriIds = $kelas->santri->pluck('id');
        $santri = Santri::whereIn('id', $santriIds)
                        ->orderBy('namaLengkap')
                        ->get();
    
        return view('nilaiK13.pts', compact('santri', 'kelas', 'mapel'));
    }
    function pas(Kelas $kelas, Mapel $mapel) {
        $santriIds = $kelas->santri->pluck('id');
        $santri = Santri::whereIn('id', $santriIds)
                        ->orderBy('namaLengkap')
                        ->get();
    
        return view('nilaiK13.pas', compact('santri', 'kelas', 'mapel'));
    }
    function lihatNilaiK13(Kelas $kelas, Mapel $mapel) {
        $santriIds = $kelas->santri->pluck('id');
        $santri = Santri::whereIn('id', $santriIds)
                        ->orderBy('namaLengkap')
                        ->get();
    
        return view('nilaiK13.nilaiRaport', compact('santri', 'kelas', 'mapel'));
    }
    function store(Request $request) {
        try {
            DB::beginTransaction();
            foreach ($request->santri_id as $index => $santriId) {
                $requestData = [
                    'santri_id' => $santriId,
                    'mapel_id' => $request->mapel_id[$index],
                    'kelas_id' => $request->kelas_id[$index],
                    'periode_id' => getPeriodeAktif()->id,
                    'kurikulum_id' => $request->kurikulum_id[$index],
                    'h1' => $request->h1[$index]?? null,
                    'h2' => $request->h2[$index]?? null,
                    'h3' => $request->h3[$index]?? null,
                    'h4' => $request->h4[$index]?? null,
                    'h5' => $request->h5[$index]?? null,
                    'h6' => $request->h6[$index]?? null,
                    'h7' => $request->h7[$index]?? null,
                    'h8' => $request->h8[$index]?? null,
                ];
    
                NilaiK13::updateOrCreate(
                    ['santri_id' => $requestData['santri_id'], 'mapel_id' => $requestData['mapel_id'], 'kelas_id' => $requestData['kelas_id'], 'periode_id' => $requestData['periode_id']],
                    $requestData
                );
            }
    
            DB::commit();
            return redirect()->back()->with('success', 'Nilai Berhasil ditambahkan');
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal. Pesan Error: '.$ex->getMessage());
        }
    }
    function storeKeterampilan(Request $request) {
        // dd($request);
        try {
            DB::beginTransaction();
            foreach ($request->santri_id as $index => $santriId) {
                $requestData = [
                    'santri_id' => $santriId,
                    'mapel_id' => $request->mapel_id[$index],
                    'kelas_id' => $request->kelas_id[$index],
                    'periode_id' => getPeriodeAktif()->id,
                    'kurikulum_id' => $request->kurikulum_id[$index],
                    'k1' => $request->k1[$index]?? null,
                    'k2' => $request->k2[$index]?? null,
                    'k3' => $request->k3[$index]?? null,
                    'k4' => $request->k4[$index]?? null,
                    'k5' => $request->k5[$index]?? null,
                    'k6' => $request->k6[$index]?? null,
                    'k7' => $request->k7[$index]?? null,
                    'k8' => $request->k8[$index]?? null,
                ];
    
                NilaiK13::updateOrCreate(
                    ['santri_id' => $requestData['santri_id'], 'mapel_id' => $requestData['mapel_id'], 'kelas_id' => $requestData['kelas_id'], 'periode_id' => $requestData['periode_id']],
                    $requestData
                );
            }
    
            DB::commit();
            return redirect()->back()->with('success', 'Nilai Berhasil ditambahkan');
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal. Pesan Error: '.$ex->getMessage());
        }
    }
    function storePTS(Request $request) {
        try {
            DB::beginTransaction();
    
            foreach ($request->santri_id as $index => $santriId) {
                $pts = $request->pts[$index] ?? null;  // Menggunakan null coalescing untuk nilai opsional
                $requestData = [
                    'santri_id' => $santriId,
                    'mapel_id' => $request->mapel_id[$index],
                    'kelas_id' => $request->kelas_id[$index],
                    'periode_id' => getPeriodeAktif()->id,
                    'kurikulum_id' => $request->kurikulum_id[$index],
                    'PTS' => $pts,
                ];
    
                NilaiK13::updateOrCreate(
                    [
                        'santri_id' => $santriId, 
                        'mapel_id' => $request->mapel_id[$index], 
                        'kelas_id' => $request->kelas_id[$index], 
                        'periode_id' => getPeriodeAktif()->id
                    ],
                    $requestData
                );
            }
    
            DB::commit();
            return redirect()->back()->with('success', 'Nilai PTS Berhasil ditambahkan');
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal. Pesan Error: ' . $ex->getMessage());
        }
    }
    function storePAS(Request $request) {
        try {
            DB::beginTransaction();
    
            foreach ($request->santri_id as $index => $santriId) {
                $pas = $request->pas[$index] ?? null;  // Menggunakan null coalescing untuk nilai opsional
                $requestData = [
                    'santri_id' => $santriId,
                    'mapel_id' => $request->mapel_id[$index],
                    'kelas_id' => $request->kelas_id[$index],
                    'periode_id' => getPeriodeAktif()->id,
                    'kurikulum_id' => $request->kurikulum_id[$index],
                    'PAS' => $pas,
                ];
    
                NilaiK13::updateOrCreate(
                    [
                        'santri_id' => $santriId, 
                        'mapel_id' => $request->mapel_id[$index], 
                        'kelas_id' => $request->kelas_id[$index], 
                        'periode_id' => getPeriodeAktif()->id
                    ],
                    $requestData
                );
            }
    
            DB::commit();
            return redirect()->back()->with('success', 'Nilai PAS Berhasil ditambahkan');
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal. Pesan Error: ' . $ex->getMessage());
        }
    }    
}

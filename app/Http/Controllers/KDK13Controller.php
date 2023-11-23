<?php

namespace App\Http\Controllers;

use App\Models\KDK13;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class KDK13Controller extends Controller
{
    function index() {
        $user = Auth::user();
        $list = Jadwal::select('mapel_id', 'kelas_id')
        ->where('guru_id', $user->guru->first()->id)
        ->where('periode_id', getPeriodeAktif()->id)
        ->groupBy('mapel_id', 'kelas_id')
        ->get();
        return view('kdk13.list',compact('list'));
    }
    function isi(Kelas $kelas,Mapel $mapel) {
        $kdPengetahuan = KDK13::select('id', 'mapel_id', 'kelas_id', 'periode_id', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'h7', 'h8')
            ->where('kelas_id',$kelas->id)->where('mapel_id',$mapel->id)
            ->get();

        $kdKeterampilan = KDK13::select('id', 'mapel_id', 'kelas_id', 'periode_id', 'k1', 'k2', 'k3', 'k4', 'k5', 'k6', 'k7', 'k8')
            ->where('kelas_id',$kelas->id)->where('mapel_id',$mapel->id)->get();
        return view('kdk13.isi',compact('kelas','mapel','kdPengetahuan','kdKeterampilan'));        
    }
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->only(['kode', 'deskripsi', 'kelas_id', 'mapel_id', 'periode_id']);

            // Dapatkan nama kolom berdasarkan nilai pada parameter "kode"
            $columnName = $data['kode'];

            // Buat array data untuk disimpan atau diperbarui ke dalam tabel
            $saveOrUpdateData = [
                'mapel_id' => $data['mapel_id'],
                'kelas_id' => $data['kelas_id'],
                'periode_id' => $data['periode_id'],
            ];

            // Atur nilai kolom deskripsi sesuai parameter "kode"
            $saveOrUpdateData[$columnName] = $data['deskripsi'];

            // Gunakan updateOrCreate untuk menyimpan atau memperbarui data
            KdK13::updateOrCreate(
                ['mapel_id' => $data['mapel_id'], 'kelas_id' => $data['kelas_id'], 'periode_id' => $data['periode_id']],
                $saveOrUpdateData
            );

            // Berikan respons atau lakukan redirect sesuai kebutuhan
            DB::commit();
            return redirect()->back()->with('success','Kompetensi Dasar Berhasil Disimpan');
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with('error','Gagal. Pesan Error: '.$ex->getMessage());
        }
        
    }
}

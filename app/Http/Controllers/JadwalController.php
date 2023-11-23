<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Nilai;
use App\Models\Jadwal;
use App\Models\Kurikulum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JadwalController extends Controller
{
    function index() {
        $kelas = Kelas::where('marhalah_id',auth()->user()->marhalah_id)->get();
        $kurikulum = Kurikulum::all();
        return view('jadwal.pilihkelas',compact('kelas','kurikulum'));
    }
    function isiJadwal(Kelas $kelas) {
        $periodeId= getPeriodeAktif()->id;
        $jadwal = Jadwal::where('periode_id',$periodeId)->where('kelas_id',$kelas->id)->get();
        $mapel=Mapel::all();
        return view('jadwal.isi',compact('kelas','periodeId','jadwal','mapel'));
    }
    function create() {
        return view('jadwal.create');
    }
    function edit(Jadwal $id){
        return view('jadwal.edit',compact('id'));        
    }
    function store(Request $request, Kelas $kelas) {
        try {
            DB::beginTransaction();
            $validasi = $this->validate($request,[
                'guru_id'=> 'string|required',
                'mapel_id'=> 'string|required',
                'hari'=> 'string|required'
                ]);
            $requestData = $request->all();
            $jadwal = new Jadwal;
            $jadwal = Jadwal::create($requestData);
            $jadwal->save();
            DB::commit();
            return redirect()->back()->with('success','Jadwal Berhasil Disimpan');
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with('error','Gagal. Pesan Error: '.$ex->getMessage());
        }
    }
    function jadwalGuru() {
        $jadwal = Jadwal::where('guru_id',auth()->user()->guru->first()->id)->get();
        return view('jadwal.jadwal-guru',compact('jadwal'));
    }
    function isiNilai(Jadwal $id) {
        $santri = $id->kelas->santri;
        return view('jadwal.nilai',compact('id','santri'));
    }
    // function jadwalNilaiSimpan(Request $request, Jadwal $jadwal) {
        
    //     try {
    //         DB::beginTransaction();
    //         $requestData = $request->all();
    //         $requestData['jadwal_id']=$jadwal->id;
    //         $nilai = new Nilai;
    //         $nilai = Nilai::updateOrCreate(
    //             ['santri_id'=>$request->santri_id,'jadwal_id'=>$jadwal->id],
    //             [
    //                 'uts'=>$request->uts,
    //                 'uas'=>$request->uas,
    //                 'harian'=>$request->harian,
    //                 'akhlak'=>$request->akhlak,
    //                 'kelas_id'=>$jadwal->kelas->id,
    //                 'mapel_id'=>$jadwal->mapel->id,
    //                 'periode_id'=>$jadwal->periode_id,
    //                 ]
    //         );
    //         $nilai->save();
    //         DB::commit();
    //         return redirect()->back()->with('success','Nilai Berhasil Disimpan');
    //     } catch (\Exception $ex) {
    //         DB::rollback();
    //         return redirect()->back()->with('error','Gagal. Pesan Error: '.$ex->getMessage());
    //     }
    // }
    function pilihKurikulum(Request $request) {
        $kelas = Kelas::findOrFail($request->kelas_id);
        $kurikulumId=$request->kurikulum_id;
        $periodeId=$request->periode_id;
        $kelas->kurikulums()->newPivotQuery()->updateOrInsert(
            ['kelas_id' => $request->kelas_id, 'periode_id' => $periodeId],
            ['kurikulum_id' => $kurikulumId]
        );
        return redirect()->back()->with('success','Kurikulum Berhasil Disimpan');

    }
}

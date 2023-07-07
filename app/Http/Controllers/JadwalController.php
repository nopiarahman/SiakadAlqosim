<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JadwalController extends Controller
{
    function index() {
        $kelas = Kelas::where('marhalah_id',auth()->user()->marhalah_id)->get();
        return view('jadwal.pilihkelas',compact('kelas'));
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
}

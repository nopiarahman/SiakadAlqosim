<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Santri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SantriController extends Controller
{
    function kelasSantri() {
        $kelas = Kelas::where('marhalah_id',auth()->user()->marhalah_id)->get();
        return view('santri.kelasSantri',compact('kelas'));
    }
    function isiKelas(Kelas $id) {
        return view('santri.isiKelas',compact('id'));
    }
    function create(Kelas $kelas) {
        return view('santri.create',compact('kelas'));
    }
    function store(Request $request, Kelas $kelas) {
        try {
            DB::beginTransaction();
            $validasi = $this->validate($request,[
                'namaLengkap'=> 'string|required',
                ]);
            $santri = new Santri;
            $santri = Santri::create($request->all());
            $santri->save();
            $kelas->santri()->attach($santri->id);
            DB::commit();
            return redirect()->route('isi-kelas',['id'=>$kelas->id])->with('success','Santri Berhasil Disimpan');
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with('error','Gagal. Pesan Error: '.$ex->getMessage());
        }
    }
}

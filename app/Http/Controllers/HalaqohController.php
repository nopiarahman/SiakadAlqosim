<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Santri;
use App\Models\Halaqoh;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HalaqohController extends Controller
{
    function index() {
        $halaqoh = Halaqoh::where('marhalah_id',auth()->user()->marhalah_id)->get();
        $guru = Guru::where('marhalah_id',auth()->user()->marhalah_id)->get();
        // dd($guru);
        return view('halaqoh.index',compact('halaqoh','guru'));
    }
    function store(Request $request) {
        try {
            DB::beginTransaction();
            $validasi = $this->validate($request,[
                'nama'=> 'string|required',
                ]);
            $halaqoh = new Halaqoh;
            $halaqoh = Halaqoh::create($request->all());
            $halaqoh['marhalah_id'] = auth()->user()->marhalah_id;
            $halaqoh->save();
            DB::commit();
            return redirect()->back()->with('success','Halaqoh Berhasil Disimpan');
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with('error','Gagal. Pesan Error: '.$ex->getMessage());
        }
    }
    function isi(Halaqoh $id) {
        $cari = "a";
        $data = Santri::select('id','namaLengkap')->where('namaLengkap','LIKE','%'.$cari.'%')
        ->where('marhalah_id',auth()->user()->marhalah_id)->get();
        
        $data->filter(function($value){
                $value['kelas']=$value->kelas->first()->nama;
                return $value;
            });
        // dd($data);
        return view('halaqoh.isi',compact('id'));
    }
    function isiSantri(Halaqoh $id, Request $request) {   
        $id->santri()->attach($request->santri_id);
        return redirect()->back()->with('success','Santri Berhasil Ditambahkan');
    }
    function deleteSantri(Halaqoh $id, Request $request) {
        $id->santri()->detach($request->santri_id);
        return redirect()->back()->with('success','Santri Berhasil Dihilangkan dari Halaqoh');
    }
}

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
        $halaqoh = Halaqoh::all();
        $guru = Guru::all();
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
    function destroy(Halaqoh $id) {
        $id->santri()->detach();
        $id->delete();
        return redirect('/halaqoh')->with('success','Halaqoh Berhasil Dihapus');

    }
}

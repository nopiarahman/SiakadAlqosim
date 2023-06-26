<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Marhalah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KelasController extends Controller
{
    function index(Marhalah $marhalah) {
        $kelas = Kelas::where('marhalah_id',$marhalah->id)->get();
        return view('kelas.index',compact('kelas','marhalah'));
    }
    function store(Request $request) {
        try {
            DB::beginTransaction();
            $validasi = $this->validate($request,[
                'nama'=> 'string|required',
                ]);
            $marhalah = new Kelas;
            $marhalah = Kelas::create($request->all());
            $marhalah->save();
            DB::commit();
            return redirect()->back()->with('success','Marhalah Berhasil Disimpan');
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with('error','Gagal. Pesan Error: '.$ex->getMessage());
        }
    }
    function update(Request $request, Kelas $id) {
        try {
            DB::beginTransaction();
            $requestData=$request->all();
            $id->update($requestData);
            DB::commit();
            return redirect()->back()->with('success','Kelas Diedit');
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with('error','Gagal. Pesan Error: '.$ex->getMessage());
        }
    }
    function destroy(Kelas $id) {
        $id->delete();
        return redirect()->back()->with('success','Kelas Dihapus');
        
    }
}

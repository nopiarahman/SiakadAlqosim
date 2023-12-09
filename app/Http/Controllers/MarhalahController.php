<?php

namespace App\Http\Controllers;

use App\Models\Marhalah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MarhalahController extends Controller
{
    function index() {
        $marhalah = Marhalah::all();
        return view('marhalah.index',compact('marhalah'));
    }
    function create() {
        return view('marhalah.create');
    }
    function store(Request $request) {
        try {
            DB::beginTransaction();
            $validasi = $this->validate($request,[
                'nama'=> 'string|required',
                ]);
            $marhalah = new Marhalah;
            $marhalah = Marhalah::create($request->all());
            $marhalah->save();
            DB::commit();
            return redirect('/marhalah')->with('success','Marhalah Berhasil Disimpan');
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with('error','Gagal. Pesan Error: '.$ex->getMessage());
        }
    }
    function edit(Marhalah $id) {
        return view('marhalah.edit',compact('id'));
    }
    function update(Request $request, Marhalah $id) {
        try {
            DB::beginTransaction();
            $requestData=$request->all();
            $id->update($requestData);
            DB::commit();
            return redirect('/marhalah')->with('success','Marhalah Diedit');
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with('error','Gagal. Pesan Error: '.$ex->getMessage());
        }
    }
    function storeKepsek(Request $request, Marhalah $id) {
        try {
            DB::beginTransaction();
            $requestData=$request->all();
            $id->update($requestData);
            DB::commit();
            return redirect()->back()->with('success','Kepala Sekolah Ditambahkan');
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with('error','Gagal. Pesan Error: '.$ex->getMessage());
        }
    }
    function destroy(Marhalah $id){
        $id->delete();
        return redirect('/marhalah')->with('success','Marhalah Berhasil Dihapus');
    }
    function kelas() {
        
        return view('marhalah.kelas');
    }
}

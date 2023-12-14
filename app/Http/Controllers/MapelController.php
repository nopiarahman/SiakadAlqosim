<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MapelController extends Controller
{
    function index() {
        $mapel = Mapel::all();
        return view('mapel.index',compact('mapel'));
    }
    function create() {
        return view('mapel.create');
    }
    function edit(Mapel $id){
        return view('mapel.edit',compact('id'));        
    }
    function store(Request $request) {
        try {
            DB::beginTransaction();
            $validasi = $this->validate($request,[
                'nama'=> 'string|required',
                'kkm'=> 'string|required',
                ]);
            $marhalah = new Mapel;
            $marhalah = Mapel::create($request->all());
            $marhalah->save();
            DB::commit();
            return redirect()->route('mapel-index')->with('success','Mapel Berhasil Disimpan');
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with('error','Gagal. Pesan Error: '.$ex->getMessage());
        }
    }
    function update(Request $request, Mapel $id) {
        // dd($request);
        try {
            DB::beginTransaction();
            $requestData=$request->all();
            $id->update($requestData);
            DB::commit();
            return redirect()->route('mapel-index')->with('success','Mapel Diedit');
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with('error','Gagal. Pesan Error: '.$ex->getMessage());
        }
    }
    function destroy(Mapel $id) {
        // TODO: tidak menghapus jadwal, dan lainnya
        $id->delete();
        return redirect()->back()->with('success','Mapel Dihapus');
        
    }
}

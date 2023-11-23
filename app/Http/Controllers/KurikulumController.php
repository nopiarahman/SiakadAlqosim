<?php

namespace App\Http\Controllers;

use App\Models\Kurikulum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KurikulumController extends Controller
{
    function index() {
        $kurikulum = Kurikulum::all();
        return view('kurikulum.index',compact('kurikulum'));
    }
    function create() {
        return view('kurikulum.create');
    }
    function store(Request $request) {
        try {
            DB::beginTransaction();
            $validasi = $this->validate($request,[
                'nama'=> 'string|required',
                ]);
            $requestData = $request->all();
            $kurikulum = new Kurikulum;
            $kurikulum = Kurikulum::create($requestData);
            $kurikulum->save();
            DB::commit();
            return redirect()->route('kurikulum-index')->with('success','Kurikulum Berhasil Disimpan');
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with('error','Gagal. Pesan Error: '.$ex->getMessage());
        }
    }
    function edit(Kurikulum $id){
        return view('kurikulum.edit',compact('id'));        
    }
    function update(Request $request, Kurikulum $id) {
        // dd($request);
        try {
            $requestData=$request->all();
            $id->update($requestData);
            DB::commit();
            return redirect()->route('kurikulum-index')->with('success','Kurikulum Diedit');
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with('error','Gagal. Pesan Error: '.$ex->getMessage());
        }
    }
    function destroy(Kurikulum $id) {
        $id->delete();
        return redirect()->back()->with('success','Kurikulum Dihapus');
        
    }
}

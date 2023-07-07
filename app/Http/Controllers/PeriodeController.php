<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeriodeController extends Controller
{
    function index() {
        $periode = Periode::all();
        return view('periode.index',compact('periode'));
    }
    function create() {
        return view('periode.create');
    }
    function edit(Periode $id){
        return view('periode.edit',compact('id'));        
    }
    function store(Request $request) {
        try {
            DB::beginTransaction();
            $validasi = $this->validate($request,[
                'semester'=> 'string|required',
                'tahun'=> 'string|required',
                'status'=> 'string|required',
                ]);
            $periode = new Periode;
            $periode = Periode::create($request->all());
            $periode->save();
            DB::commit();
            return redirect()->route('periode-index')->with('success','Periode Berhasil Disimpan');
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with('error','Gagal. Pesan Error: '.$ex->getMessage());
        }
    }
    function update(Request $request, Periode $id) {
        // dd($request);
        try {
            DB::beginTransaction();
            $requestData=$request->all();
            $id->update($requestData);
            DB::commit();
            return redirect()->route('periode-index')->with('success','Periode Diedit');
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with('error','Gagal. Pesan Error: '.$ex->getMessage());
        }
    }
    function destroy(Periode $id) {
        $id->delete();
        return redirect()->back()->with('success','Periode Dihapus');
        
    }
}

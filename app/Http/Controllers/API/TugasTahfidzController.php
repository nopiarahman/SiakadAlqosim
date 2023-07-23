<?php

namespace App\Http\Controllers\API;

use App\Models\TugasTahfidz;
use Illuminate\Http\Request;
use App\Http\Requests\TugasUpdate;
use App\Http\Controllers\Controller;
use App\Http\Resources\ListTugasResource;

class TugasTahfidzController extends Controller
{
    function index() {
        $tugas= TugasTahfidz::where('halaqoh_id',auth()->user()->guru->first()->halaqoh->first()->id)->get();
        return ListTugasResource::collection($tugas);
    }
    function store(Request $request) {
        $tugas = new TugasTahfidz;
        $tugas = TugasTahfidz::create($request->all());
        $tugas['halaqoh_id']=auth()->user()->guru->first()->halaqoh->first()->id;
        $tugas->save();
        return response()->json([
            'pesan'=>'Tugas berhasil disimpan', 
            'data'=>$tugas],200);
    }
    public function update(Request $request, $tuga) {
        $tugas = TugasTahfidz::findOrFail($tuga);
        $requestData = $request->all();
        $requestData['halaqoh_id']=auth()->user()->guru->first()->halaqoh->first()->id;
        $tugas->update($requestData);
        return response()->json([
            'pesan'=>'Tugas berhasil diedit!', 
            'data'=>$tugas],200);
    }
    function destroy(TugasTahfidz $tuga) {
        $tuga->delete();
        return response()->json("berhasil dihapus",200);
    }
    function list() {
        $tugas= TugasTahfidz::where('halaqoh_id',auth()->user()->santri->first()->halaqoh->first()->id)->get();
        return GetListTugas::collection($tugas);
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Models\TugasTahfidz;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NilaiTahfidzController extends Controller
{
    function index(TugasTahfidz $tugas) {
        $nilai = $tugas->nilai_tahfidz;
        return response()->json($nilai, 200);
    }
    function kirim(Request $request, TugasTahfidz $tugas) {
        $santri=auth()->user()->santri->first();
        $validasi = $this->validate($request,[
            'audio'=> 'required',
            ]);
        $requestData = $request->all();
        $requestData['santri_id']=$santri->id;
        $requestData['tugasTahfidz_id']=$tugas->id;
        $nilai = NilaiTahfidz::create($requestData);
        if($request->hasFile('audio')){
            $nilai->addMediaFromRequest('audio')
            ->toMediaCollection('audio');
        }
        $nilai->save();
        return response()->json([
            'pesan'=>'Tugas berhasil dikirim', 
            'data'=>$nilai],200);
    }
}

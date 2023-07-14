<?php

namespace App\Http\Controllers\API;

use App\Models\NilaiTahfidz;
use App\Models\TugasTahfidz;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

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
        $requestData['tugas_tahfidz_id']=$tugas->id;
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
    function pengumpulan(TugasTahfidz $tugas) {
        $kumpul = $tugas->nilaiTahfidz;
        return response()->json([
            'pesan'=>'List Pengumpulan Tugas Santri', 
            'data'=>$kumpul],200);

    }
    function koreksi(Request $request, NilaiTahfidz $nilai){
        $url = $nilai->getFirstMediaUrl('audio');
        return response()->json($url, 200);

    }
}

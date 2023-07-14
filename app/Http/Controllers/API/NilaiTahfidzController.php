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
        $santri=auth()->user();
        $validasi = $this->validate($request,[
            'audio'=> 'required',
            ]);
        // $requestData = $request->all();
        // $requestData['santri_id']=$santri;
        // $requestData['tugas_tahfidz_id']=$tugas->id;
        // $nilai = NilaiTahfidz::create($requestData);
        // if($request->hasFile('audio')){
        //     $nilai->addMediaFromRequest('audio')
        //     ->toMediaCollection('audio');
        // }
        // $nilai->save();
        return response()->json([
            'pesan'=>'Tugas berhasil dikirim', 
            'data'=>$santri],200);
    }
    function pengumpulan(TugasTahfidz $tugas) {
        $kumpul = $tugas->nilaiTahfidz;
        return response()->json([
            'pesan'=>'List Pengumpulan Tugas Santri', 
            'data'=>$kumpul],200);

    }
    function koreksi(Request $request, NilaiTahfidz $nilai){
        $url = $nilai->getFirstMediaUrl('audio');
        $data = $nilai->tugasTahfidz;
        $data['url']=$url;
        $data['nilai_id']=$nilai->id;

        return response()->json([
            'pesan'=>'Hasil Tugas Santri', 
            'data'=>$data],200);

    }
    function simpanKoreksi(NilaiTahfidz $nilai, Request $request) {
        $nilai->update([
            'nilai'=>$request->nilai
        ]);
        return response()->json([
            'pesan'=>'Berhasil Diberi nilai', 
            'data'=>$nilai],200);
    }
}

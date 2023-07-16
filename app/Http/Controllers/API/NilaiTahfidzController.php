<?php

namespace App\Http\Controllers\API;

use App\Models\NilaiTahfidz;
use App\Models\TugasTahfidz;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\ListTugasResource;

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
        $cekData = NilaiTahfidz::where('santri_id',$santri->id)->where('tugas_tahfidz_id',$tugas->id)->first();
        if($cekData){
            return response()->json([
                'pesan'=>'Tugas sudah pernah dikumpulkan'],401);
        }
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
    function pengumpulanTugas(TugasTahfidz $tugas) {
        $kumpul = $tugas->nilaiTahfidz;
        $data = [];
        foreach ($kumpul as $i) {
            $data = $i;
            $data['audio']=$i->getFirstMediaUrl('audio');
        }
        return response()->json([
            'pesan'=>'List Pengumpulan Tugas Santri', 
            'data'=>$kumpul],200);
    }
    function listPengumpulan() {
        $tugas= TugasTahfidz::all();
        return ListTugasResource::collection($tugas);
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
    function lihat() {
        $nilai = NilaiTahfidz::where('santri_id',auth()->user()->santri->first()->id)->get();
        if($nilai == null){
            return response()->json('tidak ada data', 200);
        }
        return response()->json([
            'pesan'=>'List Nilai', 
            'data'=>$nilai],200);
    }
}

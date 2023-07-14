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
        return response()->json([
            'pesan'=>'Tugas berhasil dikirim', 
            'data'=>$request->file('audio')],200);
    }
}

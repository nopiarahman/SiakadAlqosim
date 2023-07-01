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
}

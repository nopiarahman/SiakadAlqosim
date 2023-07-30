<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HafalanController extends Controller
{
    function index(Santri $santri) {
        $hafalan = Hafalan::where('santri_id',$santri->id)->get();
        return response()->json([
            'pesan'=>'Tugas berhasil diedit!', 
            'data'=>$hafalan],200);
    }
}

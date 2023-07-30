<?php

namespace App\Http\Controllers;

use App\Models\Santri;
use App\Models\Hafalan;
use Illuminate\Http\Request;

class HafalanController extends Controller
{
    function index(Santri $santri) {
        $hafalan = Hafalan::where('santri_id',$santri->id)->get();
        return response()->json([
            'pesan'=>'Tugas berhasil diedit!', 
            'data'=>$hafalan],200);
    }
    function create(Request $request, Santri $santri) {
        $hafalan = new Hafalan;
        $hafalan = Hafalan::create($request->all());
        $hafalan['santri_id']=$santri->id;
        $hafalan->save();
        return response()->json([
            'pesan'=>'Hafalan berhasil disimpan', 
            'data'=>$hafalan],200);
    }
}

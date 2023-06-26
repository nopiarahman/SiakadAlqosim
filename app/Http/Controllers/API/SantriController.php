<?php

namespace App\Http\Controllers\API;

use App\Models\Kelas;
use App\Models\Santri;
use App\Models\Marhalah;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\IsiKelasResource;
use App\Http\Resources\API\SantriResource;
use App\Http\Resources\KelasSantriResource;

class SantriController extends Controller
{
    function index() {
        $santri = Santri::all();
        return SantriResource::collection($santri);
    }
    function kelasSantri() {
        $kelas = Kelas::where('marhalah_id',auth()->user()->marhalah_id)->get();
        return KelasSantriResource::collection($kelas);
    }
    function isiKelas(Kelas $id) {
        $santri = $id->santri;
        return IsiKelasResource::collection($santri);
    }
}

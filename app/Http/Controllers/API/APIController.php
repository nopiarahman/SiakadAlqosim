<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Halaqoh;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Resources\DaftarSantriHalaqoh;

class APIController extends Controller
{
    function halaqoh() {
        $halaqoh = Halaqoh::where('guru_id',auth()->user()->guru->first()->id)->first();
        // return response()->json($halaqoh, 200);
        return DaftarSantriHalaqoh::collection($halaqoh->santri);
    }
}

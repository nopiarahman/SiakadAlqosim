<?php

namespace App\Http\Controllers\API;

use App\Models\Santri;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\API\SantriResource;

class SantriController extends Controller
{
    function index() {
        $santri = Santri::all();
        return SantriResource::collection($santri);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Marhalah;
use Illuminate\Http\Request;

class MarhalahController extends Controller
{
    function index() {
        $marhalah = Marhalah::all();
        return view('marhalah.index',compact('marhalah'));
    }
    function kelas() {
        
        return view('marhalah.kelas');
    }
}

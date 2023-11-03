<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    function form() {
        $link = collect([
            'ra'=>'https://forms.gle/BfwaLFat4QLikmZF7',
            'ula'=>'https://forms.gle/vWZ9E8LDyVM2YHYM8',
            'putra'=>'https://forms.gle/tPnWWuYcUaVpPK9a6',
            'putri'=>'https://forms.gle/gEjHjwQS7azu24Hq5',
        ]);
        return view('formulir',compact('link'));
    }
}

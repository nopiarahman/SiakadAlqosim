<?php

use App\Models\Periode;

function getPeriodeAktif() {
    $periode = Periode::where('status','aktif')->first();
    return $periode;
}


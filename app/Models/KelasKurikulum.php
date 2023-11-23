<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KelasKurikulum extends Pivot
{
    protected $guarded =['id','created_at','updated_at'];

    // public function periode()
    // {
    //     return $this->belongsTo(Periode::class, 'periode_id');
    // }
    // public function kelasKurikulum()
    // {
    //     return $this->hasMany(KelasKurikulum::class, 'periode_id');
    // }
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function kurikulum()
    {
        return $this->belongsTo(Kurikulum::class, 'kurikulum_id');
    }
}

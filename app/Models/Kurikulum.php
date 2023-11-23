<?php

namespace App\Models;

use App\Models\Kelas;
use App\Models\KelasKurikulum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Kurikulum extends Model
{
    use HasFactory;
    protected $table = "kurikulum";
    protected $guarded =['id','created_at','updated_at'];

    public function kelasKurikulums(): BelongsToMany
    {
        return $this->belongsToMany(Kelas::class, 'kelas_kurikulum')
            ->using(KelasKurikulum::class)
            ->withPivot('periode_id');
    }
    public function periode()
    {
        return $this->belongsToMany(Periode::class, 'kelas_kurikulum', 'kurikulum_id', 'periode_id')
            ->using(KelasKurikulum::class)
            ->withPivot('kelas_id');
    }
}

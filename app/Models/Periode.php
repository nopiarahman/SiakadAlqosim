<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periode extends Model
{
    use HasFactory;
    protected $table = "periode";
    protected $guarded =['id','created_at','updated_at'];

    public function kelasKurikulums()
    {
        return $this->hasMany(KelasKurikulum::class, 'periode_id');
    }
    /**
     * Get all of the kdk13 for the Periode
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function kdk13(): HasMany
    {
        return $this->hasMany(KDK13::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DataRaportK13 extends Model
{
    use HasFactory;
    protected $table = "data_raport_k13";
    protected $guarded =['id','created_at','updated_at'];

    /**
     * Get all of the ekstrakurikuler for the DataRaportK13
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ekstrakurikuler(): HasMany
    {
        return $this->hasMany(Ekstrakurikuler::class);
    }
    /**
     * Get all of the prestasi for the DataRaportK13
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function prestasi(): HasMany
    {
        return $this->hasMany(Prestasi::class);
    }
    /**
     * Get all of the sikap for the DataRaportK13
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sikap(): HasMany
    {
        return $this->hasMany(SikapK13::class);
    }
}

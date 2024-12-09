<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mapel extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table = "mapel";
    protected $guarded =['id','created_at','updated_at','deleted_at'];

    /**
     * Get all of the jadwal for the Mapel
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function jadwal(): HasMany
    {
        return $this->hasMany(Jadwal::class);
    }
    /**
     * Get all of the kdk13 for the Mapel
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function kdk13(): HasMany
    {
        return $this->hasMany(KDK13::class);
    }
    /**
     * Get all of the nilaik13 for the Mapel
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function nilaik13(): HasMany
    {
        return $this->hasMany(NilaiK13::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mapel extends Model
{
    use HasFactory;
    protected $table = "mapel";
    protected $guarded =['id','created_at','updated_at'];

    /**
     * Get all of the jadwal for the Mapel
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function jadwal(): HasMany
    {
        return $this->hasMany(Jadwal::class);
    }
}

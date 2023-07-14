<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class TugasTahfidz extends Model
{
    use HasFactory;
    protected $table = "tugasTahfidz";
    protected $guarded =['id','created_at','updated_at'];

    /**
     * The roles that belong to the TugasTahfidz
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function santri(): BelongsToMany
    {
        return $this->belongsToMany(Santri::class, 'nilai_tahfidz', 'santri_id', 'tugasTahfidz_id')->as('nilaiTahfidz')->withPivot('nilai');;
    }
    /**
     * Get all of the nilaiTahfidz for the TugasTahfidz
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function nilaiTahfidz(): HasMany
    {
        return $this->hasMany(NilaiTahfidz::class);
    }
}

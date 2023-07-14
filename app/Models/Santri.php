<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Santri extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $table = "santri";
    protected $guarded =['id','created_at','updated_at'];

    /**
     * The kelas that belong to the Santri
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function kelas()
    {
        return $this->belongsToMany(Kelas::class);
    }
    /**
     * The halaqoh that belong to the Santri
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function halaqoh()
    {
        return $this->belongsToMany(Halaqoh::class);
    }
    /**
     * The nilaiTahfidz that belong to the Santri
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function nilaiTahfidz(): BelongsToMany
    {
        return $this->belongsToMany(TugasTahfidz::class,'nilai_tahfidz', 'santri_id', 'tugasTahfidz_id')->as('nilaiTahfidz')->withPivot('nilai');
    }
    /**
     * Get the user that owns the Santri
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    /**
     * Get all of the Wali for the Santri
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Wali(): HasOne
    {
        return $this->hasOne(Wali::class);
    }
    /**
     * Get all of the nilaiTahfidz for the Santri
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function nilai_tahfidz(): HasMany
    {
        return $this->hasMany(NilaiTahfidz::class);
    }
}

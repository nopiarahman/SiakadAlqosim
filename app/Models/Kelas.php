<?php

namespace App\Models;

use App\Models\Kurikulum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Kelas extends Model
{
    use HasFactory;
    protected $table = "kelas";
    protected $guarded =['id','created_at','updated_at'];

    /**
     * Get the marhalah that owns the Kelas
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function marhalah()
    {
        return $this->belongsTo(Marhalah::class);
    }
    /**
     * The santri that belong to the Kelas
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function santri()
    {
        return $this->belongsToMany(Santri::class);
    }
    /**
     * Get all of the jadwal for the Kelas
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function jadwal(): HasMany
    {
        return $this->hasMany(Jadwal::class);
    }
    /**
     * Get the waliKelas associated with the Kelas
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function waliKelas(): HasOne
    {
        return $this->hasOne(WaliKelas::class);
    }
    /**
     * The kurikulum that belong to the Kelas
     *
     * @return BelongsToMany
     */
    public function kurikulums()
    {
        return $this->belongsToMany(Kurikulum::class, 'kelas_kurikulum')
            ->using(KelasKurikulum::class)
            ->withPivot('periode_id');
    }
    public function addOrUpdateKurikulum($kurikulumId, $periodeId)
    {
        return $this->kurikulum()->syncWithoutDetaching([
            $kurikulumId => ['periode_id' => $periodeId]
        ]);
    }
}

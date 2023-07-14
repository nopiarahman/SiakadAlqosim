<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NilaiTahfidz extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    protected $table = "nilaiTahfidz";
    protected $guarded =['id','created_at','updated_at'];

    /**
     * Get the tugasTahfidz that owns the NilaiTahfidz
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tugasTahfidz(): BelongsTo
    {
        return $this->belongsTo(TugasTahfidz::class);
    }
    /**
     * Get the santri that owns the NilaiTahfidz
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function santri(): BelongsTo
    {
        return $this->belongsTo(Santri::class);
    }
}

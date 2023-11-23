<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KDK13 extends Model
{
    use HasFactory;
    protected $table = "kd_k13";
    protected $guarded =['id','created_at','updated_at'];

    /**
     * Get the mapel that owns the KDK13
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function mapel(): BelongsTo
    {
        return $this->belongsTo(Mapel::class);
    }
    /**
     * Get the periode that owns the KDK13
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function periode(): BelongsTo
    {
        return $this->belongsTo(Periode::class);
    }
    public function getDeskripsiKDByNilai($key)
    {
        // Ambil deskripsi KD berdasarkan nilai terbesar atau terkecil
        return $this->$key;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jadwal extends Model
{
    use HasFactory;
    protected $table = "jadwal";
    protected $guarded =['id','created_at','updated_at'];

    /**
     * Get the user that owns the Jadwal
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Kelas(): BelongsTo
    {
        return $this->belongsTo(Kelas::class);
    }
    /**
     * Get the guru that owns the Jadwal
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function guru(): BelongsTo
    {
        return $this->belongsTo(Guru::class);
    }
    /**
     * Get the mapel that owns the Jadwal
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function mapel(): BelongsTo
    {
        return $this->belongsTo(Mapel::class);
    }
}

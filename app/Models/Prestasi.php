<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Prestasi extends Model
{
    use HasFactory;
    protected $table = "prestasi";
    protected $guarded =['id'];

    /**
     * Get the dataRaportK13 that owns the Prestasi
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dataRaportK13(): BelongsTo
    {
        return $this->belongsTo(DataRaportK13::class);
    }
}

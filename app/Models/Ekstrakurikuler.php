<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ekstrakurikuler extends Model
{
    use HasFactory;
    protected $table = "ekstrakurikuler";
    protected $guarded =['id','created_at','updated_at'];

    /**
     * Get the dataRaportK13 that owns the Ekstrakurikuler
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dataRaportK13(): BelongsTo
    {
        return $this->belongsTo(DataRaportK13::class);
    }
}

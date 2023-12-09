<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SikapK13 extends Model
{
    use HasFactory;
    protected $table = "sikap_k13";
    protected $guarded =['id','created_at','updated_at'];
    /**
     * Get the dataRaportK13 that owns the SikapK13
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dataRaportK13(): BelongsTo
    {
        return $this->belongsTo(DataRaportK13::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Hafalan extends Model
{
    use HasFactory;
    protected $table = "hafalan";
    protected $guarded =['id','created_at','updated_at'];

/**
 * Get the santri that owns the Hafalan
 *
 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
 */
public function santri(): BelongsTo
{
    return $this->belongsTo(Santri::class);
}
    
}

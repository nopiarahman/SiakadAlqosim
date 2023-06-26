<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}

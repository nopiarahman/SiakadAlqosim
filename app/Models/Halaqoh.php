<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Halaqoh extends Model
{
    use HasFactory;
    protected $table = "halaqoh";
    protected $guarded =['id','created_at','updated_at'];

    /**
     * Get the guru that owns the Halaqoh
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }
    /**
     * The santri that belong to the Halaqoh
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function santri()
    {
        return $this->belongsToMany(Santri::class);
    }
}

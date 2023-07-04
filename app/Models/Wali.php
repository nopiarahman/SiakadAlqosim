<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Wali extends Model
{
    use HasFactory;
    protected $table = "wali";
    protected $guarded =['id','created_at','updated_at'];

    /**
     * Get the Santri that owns the Wali
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Santri(): BelongsTo
    {
        return $this->belongsTo(Santri::class);
    }
    /**
     * Get the user that owns the Wali
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

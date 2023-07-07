<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Guru extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    protected $table = "guru";
    protected $guarded =['id','created_at','updated_at'];
    
    /**
     * Get the user that owns the Guru
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    /**
     * Get all of the halaqoh for the Guru
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function halaqoh()
    {
        return $this->hasMany(Halaqoh::class);
    }
    /**
     * Get all of the jadwal for the Guru
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function jadwal(): HasMany
    {
        return $this->hasMany(Jadwal::class);
    }
}

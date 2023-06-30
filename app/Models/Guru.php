<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

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
}

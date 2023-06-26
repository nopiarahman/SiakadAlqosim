<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
class Santri extends Model
{
    use HasFactory;
    use InteractsWithMedia;

    protected $table = "santri";
    protected $guarded =['id','created_at','updated_at'];

    /**
     * The kelas that belong to the Santri
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function kelas()
    {
        return $this->belongsToMany(Kelas::class);
    }
}

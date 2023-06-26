<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marhalah extends Model
{
    use HasFactory;
    protected $table = "marhalah";
    protected $guarded =['id','created_at','updated_at'];

    /**
     * Get all of the kelas for the Marhalah
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function kelas()
    {
        return $this->hasMany(kelas::class);
    }
    /**
     * Get all of the user for the Marhalah
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function user()
    {
        return $this->hasMany(user::class);
    }
    
}

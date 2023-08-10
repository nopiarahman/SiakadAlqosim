<?php

namespace App\Models;

use App\Models\Kelas;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        return $this->hasMany(Kelas::class);
    }
    /**
     * Get all of the user for the Marhalah
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function user()
    {
        return $this->hasMany(User::class);
    }
    /**
     * Get all of the santri for the Marhalah
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function santri()
    {
        return $this->hasMany(Santri::class);
    }
    
}

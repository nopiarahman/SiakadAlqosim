<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marhalah extends Model
{
    use HasFactory;
    protected $table = "marhalah";
    protected $guarded =['id','created_at','updated_at'];
}

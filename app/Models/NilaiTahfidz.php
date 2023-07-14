<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class NilaiTahfidz extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    protected $table = "nilaiTahfidz";
    protected $guarded =['id','created_at','updated_at'];
}

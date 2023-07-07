<?php

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Periode;
use App\Models\Marhalah;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwal', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Kelas::class)->onDelete('CASCADE');
            $table->foreignIdFor(Guru::class)->onDelete('CASCADE');
            $table->foreignIdFor(Mapel::class)->onDelete('CASCADE');
            $table->foreignIdFor(Periode::class)->onDelete('CASCADE');
            $table->string('hari');
            $table->time('mulai')->nullable();
            $table->time('selesai')->nullable();
            $table->foreignIdFor(Marhalah::class)->onDelete('CASCADE');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jadwal');
    }
};

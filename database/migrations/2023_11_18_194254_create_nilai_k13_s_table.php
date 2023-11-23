<?php

use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Jadwal;
use App\Models\Santri;
use App\Models\Periode;
use App\Models\Kurikulum;
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
        Schema::create('nilai_k13', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Santri::class)->onDelete('CASCADE')->nullable();
            $table->foreignIdFor(Kelas::class)->onDelete('CASCADE')->nullable();
            $table->foreignIdFor(Mapel::class)->onDelete('CASCADE')->nullable();
            $table->foreignIdFor(Periode::class)->onDelete('CASCADE')->nullable();
            $table->foreignIdFor(Kurikulum::class)->onDelete('CASCADE')->nullable();
            $table->integer('PTS')->nullable();
            $table->integer('PAS')->nullable();
            $table->integer('h1')->nullable();
            $table->integer('h2')->nullable();
            $table->integer('h3')->nullable();
            $table->integer('h4')->nullable();
            $table->integer('h5')->nullable();
            $table->integer('h6')->nullable();
            $table->integer('h7')->nullable();
            $table->integer('h8')->nullable();
            $table->integer('k1')->nullable();
            $table->integer('k2')->nullable();
            $table->integer('k3')->nullable();
            $table->integer('k4')->nullable();
            $table->integer('k5')->nullable();
            $table->integer('k6')->nullable();
            $table->integer('k7')->nullable();
            $table->integer('k8')->nullable();
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
        Schema::dropIfExists('nilai_k13');
    }
};

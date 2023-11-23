<?php

use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Periode;
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
        Schema::create('kd_k13', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Mapel::class)->onDelete('CASCADE')->nullable();
            $table->foreignIdFor(Kelas::class)->onDelete('CASCADE')->nullable();
            $table->foreignIdFor(Periode::class)->onDelete('CASCADE')->nullable();
            $table->string('h1')->nullable();
            $table->string('h2')->nullable();
            $table->string('h3')->nullable();
            $table->string('h4')->nullable();
            $table->string('h5')->nullable();
            $table->string('h6')->nullable();
            $table->string('h7')->nullable();
            $table->string('h8')->nullable();
            $table->string('k1')->nullable();
            $table->string('k2')->nullable();
            $table->string('k3')->nullable();
            $table->string('k4')->nullable();
            $table->string('k5')->nullable();
            $table->string('k6')->nullable();
            $table->string('k7')->nullable();
            $table->string('k8')->nullable();
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
        Schema::dropIfExists('kd_k13');
    }
};

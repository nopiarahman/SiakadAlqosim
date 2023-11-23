<?php

use App\Models\Kelas;
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
        Schema::create('kelas_kurikulum', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Kelas::class)->onDelete('CASCADE')->nullable();
            $table->foreignIdFor(Kurikulum::class)->onDelete('CASCADE')->nullable();
            $table->foreignIdFor(Periode::class)->onDelete('CASCADE')->nullable();
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
        Schema::dropIfExists('kelas_kurikulum');
    }
};

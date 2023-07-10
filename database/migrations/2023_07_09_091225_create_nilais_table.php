<?php

use App\Models\Jadwal;
use App\Models\Santri;
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
        Schema::create('nilai', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Santri::class)->onDelete('CASCADE')->nullable();
            $table->foreignIdFor(Jadwal::class)->onDelete('CASCADE')->nullable();
            $table->integer('harian')->nullable();
            $table->integer('uts')->nullable();
            $table->integer('uas')->nullable();
            $table->integer('akhlak')->nullable();
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
        Schema::dropIfExists('nilai');
    }
};

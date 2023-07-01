<?php

use App\Models\Santri;
use App\Models\TugasTahfidz;
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
        Schema::create('nilai_tahfidz', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Santri::class)->onDelete('CASCADE');
            $table->foreignIdFor(TugasTahfidz::class)->onDelete('CASCADE');
            $table->string('nilai');
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
        Schema::dropIfExists('nilai_tahfidz');
    }
};

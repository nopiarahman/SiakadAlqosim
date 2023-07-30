<?php

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
        Schema::create('hafalan', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Santri::class)->onDelete('CASCADE')->nullable();
            $table->string('jenisHafalan');
            $table->string('jenisSurah');
            $table->string('mulai')->nullable();
            $table->string('selesai')->nullable();
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
        Schema::dropIfExists('hafalan');
    }
};

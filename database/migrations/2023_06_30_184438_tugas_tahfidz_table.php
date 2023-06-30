<?php

use App\Models\Halaqoh;
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
        Schema::create('tugasTahfidz', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Halaqoh::class)->onDelete('CASCADE')->nullable();
            $table->string('namaTugas');
            $table->string('jenisSurah')->nullable();
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
        Schema::dropIfExists('tugasTahfidz');
    }
};

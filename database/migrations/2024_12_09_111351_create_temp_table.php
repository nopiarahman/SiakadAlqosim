<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTempTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temp', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained('users') // Pastikan tabel users ada
                ->onDelete('cascade'); // Jika user dihapus, data di temp juga dihapus

            $table->foreignId('periode_id')
                ->constrained('periode') // Pastikan tabel periode ada
                ->onDelete('cascade'); // Jika periode dihapus, data di temp juga dihapus

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
        Schema::dropIfExists('temp');
    }
}

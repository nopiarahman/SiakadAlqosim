<?php

use App\Models\DataRaportK13;
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
        Schema::create('sikap_k13', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(DataRaportK13::class)->onDelete('CASCADE')->nullable();
            $table->string('predikat_spiritual')->nullable();
            $table->text('deskripsi_spiritual')->nullable();
            $table->string('predikat_sosial')->nullable();
            $table->text('deskripsi_sosial')->nullable();
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
        Schema::dropIfExists('sikap_k13');
    }
};

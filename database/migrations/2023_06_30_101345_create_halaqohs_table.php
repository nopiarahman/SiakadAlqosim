<?php

use App\Models\Guru;
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
        Schema::create('halaqoh', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Marhalah::class)->onDelete('CASCADE')->nullable();
            $table->foreignIdFor(Guru::class)->onDelete('CASCADE')->nullable();
            $table->string('nama');
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
        Schema::dropIfExists('halaqoh');
    }
};

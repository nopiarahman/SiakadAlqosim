<?php

use App\Models\Santri;
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
        Schema::create('halaqoh_santri', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Santri::class)->onDelete('CASCADE')->nullable();
            $table->foreignIdFor(Halaqoh::class)->onDelete('CASCADE')->nullable();
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
        Schema::dropIfExists('halaqoh_santri');
    }
};

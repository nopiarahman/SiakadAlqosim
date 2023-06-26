<?php

use App\Models\Kelas;
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
        Schema::create('kelas_santri', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Kelas::class)->onDelete('CASCADE');
            $table->foreignIdFor(Santri::class)->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kelas_santri');
    }
};

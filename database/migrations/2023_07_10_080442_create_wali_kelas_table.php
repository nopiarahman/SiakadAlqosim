<?php

use App\Models\Guru;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Periode;
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
        Schema::create('waliKelas', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->onDelete('CASCADE');
            $table->foreignIdFor(Kelas::class)->onDelete('CASCADE');
            $table->foreignIdFor(Guru::class)->onDelete('CASCADE');
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
        Schema::dropIfExists('waliKelas');
    }
};

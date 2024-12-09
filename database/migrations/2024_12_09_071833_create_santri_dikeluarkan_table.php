<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('santri_dikeluarkan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('santri_id')->constrained('santri')->onDelete('cascade');
            $table->foreignId('kelas_sebelum_id')->nullable()->constrained('kelas')->onDelete('set null');
            $table->date('tanggal_dikeluarkan');
            $table->text('alasan_dikeluarkan');
            $table->string('file_pendukung')->nullable(); // Path file pendukung
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('santri_dikeluarkan');
    }
};


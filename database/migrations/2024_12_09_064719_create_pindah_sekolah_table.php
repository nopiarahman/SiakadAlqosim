<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pindah_sekolah', function (Blueprint $table) {
            $table->id();
            $table->foreignId('santri_id')->constrained('santri')->onDelete('cascade'); // Relasi ke tabel santri
            $table->foreignId('kelas_sebelum_id')->nullable()->constrained('kelas')->onDelete('set null'); // Relasi ke tabel kelas
            $table->string('sekolah_tujuan'); // Nama sekolah tujuan
            $table->date('tanggal_pindah'); // Tanggal pindah
            $table->text('alasan_pindah'); // Alasan pindah
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pindah_sekolah');
    }
};

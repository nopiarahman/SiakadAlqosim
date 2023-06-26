<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('santri', function (Blueprint $table) {
            $table->id();
            $table->string('nik')->nullable();
            $table->string('namaLengkap');
            $table->string('namaPanggilan')->nullable();
            $table->string('tempatLahir')->nullable();
            $table->date('tanggalLahir')->nullable();
            $table->string('jenisKelamin')->nullable();
            $table->string('bahasaKeseharian')->nullable();
            $table->string('golonganDarah')->nullable();
            $table->string('penyakit')->nullable();
            $table->string('baju')->nullable();
            $table->string('sekolahSebelum')->nullable();
            $table->string('alamatSekolahSebelum')->nullable();
            $table->string('nisnSekolahSebelum')->nullable();
            $table->string('namaAyah')->nullable();
            $table->string('namaPanggilanAyah')->nullable();
            $table->string('pendidikanAyah')->nullable();
            $table->string('tanggalLahirAyah')->nullable();
            $table->string('pekerjaanAyah')->nullable();
            $table->string('alamatAyah')->nullable();
            $table->string('penghasilanAyah')->nullable();
            $table->string('teleponAyah')->nullable();
            $table->string('emailAyah')->nullable();
            $table->string('namaIbu')->nullable();
            $table->string('namaPanggilanIbu')->nullable();
            $table->string('tempatLahirIbu')->nullable();
            $table->string('tanggalLahirIbu')->nullable();
            $table->string('pendidikanIbu')->nullable();
            $table->string('pekerjaanIbu')->nullable();
            $table->string('alamatIbu')->nullable();
            $table->string('penghasilanIbu')->nullable();
            $table->string('teleponIbu')->nullable();
            $table->string('emailIbu')->nullable();
            $table->string('namaWali')->nullable();
            $table->string('namaPanggilanWali')->nullable();
            $table->string('tempatlLahirWali')->nullable();
            $table->string('tanggalLahirWali')->nullable();
            $table->string('pendidikanWali')->nullable();
            $table->string('pekerjaanWali')->nullable();
            $table->string('alamatWali')->nullable();
            $table->string('penghasilanWali')->nullable();
            $table->string('teleponWali')->nullable();
            $table->string('emailWali')->nullable();
            $table->string('jenjang')->nullable();
            $table->string('angkatan')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('santri');
    }
};

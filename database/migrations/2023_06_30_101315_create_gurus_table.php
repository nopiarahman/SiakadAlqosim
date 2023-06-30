<?php

use App\Models\User;
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
        Schema::create('guru', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Marhalah::class)->onDelete('CASCADE')->nullable();
            $table->foreignIdFor(User::class)->onDelete('CASCADE')->nullable();
            $table->string('nama');
            $table->string('noKTP')->nullable();
            $table->string('tempatLahir')->nullable();
            $table->string('tanggalLahir')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('golDarah')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->string('tinggiBadan')->nullable();
            $table->string('BeratBadan')->nullable();
            $table->string('Pendidikan')->nullable();
            $table->string('namaInstitusi')->nullable();
            $table->string('alamat')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kabupaten')->nullable();
            $table->string('kodePos')->nullable();
            $table->string('noHP')->nullable();
            $table->string('email')->nullable();
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
        Schema::dropIfExists('guru');
    }
};

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
        Schema::table('santri', function (Blueprint $table) {
            $table->string('nis')->nullable();
            $table->string('alamat')->nullable();
        });
    }

    public function down()
    {
        Schema::table('santri', function (Blueprint $table) {
            $table->dropColumn('nis');
            $table->dropColumn('alamat');
        });
    }
};
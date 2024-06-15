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
        Schema::table('data_raport_k13', function (Blueprint $table) {
            $table->string('status')->nullable();
            $table->string('tujuan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('data_raport_k13', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('tujuan');
            
        });
    }
};

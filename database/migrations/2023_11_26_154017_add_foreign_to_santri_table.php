<?php

use App\Models\Prestasi;
use App\Models\Ekstrakurikuler;
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
        Schema::table('data_raport_k13', function (Blueprint $table) {
            $table->foreignIdFor(Ekstrakurikuler::class)->onDelete('CASCADE')->nullable();
            $table->foreignIdFor(Prestasi::class)->onDelete('CASCADE')->nullable();
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
            $table->dropForeign(['prestasi_id']);
            $table->dropForeign(['ekstrakurikuler_id']);
        });
    }
};

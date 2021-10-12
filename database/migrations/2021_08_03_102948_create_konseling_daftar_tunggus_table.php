<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKonselingDaftarTunggusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('konseling_daftar_tunggus', function (Blueprint $table) {
            $table->unsignedBigInteger('assesment_sesi_id')->unique();
            $table->foreign('assesment_sesi_id')->references('id')->on('assesment_sesis');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('konseling_daftar_tunggus');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKonselingJadwalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('konseling_jadwals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('konseling_sesi_id');
            $table->date('konseling_tanggal');
            $table->text('konseling_catatan');
            $table->timestamps();

            $table->foreign('konseling_sesi_id')->references('id')->on('konseling_sesis');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('konseling_jadwals');
    }
}
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKonselingSesisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('konseling_sesis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('konselor_id');
            $table->unsignedBigInteger('assesment_sesi_id')->unique();
            $table->string('konseling_kode',100);
            $table->enum('konseling_status',[0,1]);
            $table->enum('konseling_setuju',[0,1]);
            $table->text('konseling_catatan');
            $table->timestamps();

            $table->foreign('konselor_id')->references('id')->on('konselors');
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
        Schema::dropIfExists('konseling_sesis');
    }
}
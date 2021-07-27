<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssesmentJawabansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assesment_jawabans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('assesment_id');
            $table->unsignedBigInteger('assesment_sesi_id');
            $table->enum('jawaban',[1,0]);
            $table->timestamps();

            $table->foreign('assesment_id')->references('id')->on('assesments');
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
        Schema::dropIfExists('assesment_jawabans');
    }
}
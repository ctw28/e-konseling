<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssesmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assesments', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('no_urut');
            $table->string('soal');
            $table->smallInteger('soal_sebelum')->nullable();
            $table->smallInteger('soal_setelah')->nullable();
            $table->unsignedBigInteger('assesment_jenis_aum_id');
            $table->timestamps();

            $table->foreign('assesment_jenis_aum_id')->references('id')->on('assesment_jenis_aums');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assesments');
    }
}
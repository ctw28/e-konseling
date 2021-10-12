<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssesmentSesisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assesment_sesis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); //ini dari iddata SIA diambil
            $table->string('sesi_kode',200);
            $table->enum('sesi_status',[0,1]);
            $table->enum('lanjut_konseling',[0,1])->default(0);
            $table->text('sesi_catatan')->nullable();
            $table->timestamp('sesi_tanggal')->nullable();

            $table->foreign('user_id')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assesment_sesis');
    }
}
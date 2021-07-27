<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKonselorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('konselors', function (Blueprint $table) {
            $table->id();
            $table->string('konselor_pegawai_id',100); //ambil dari API data pegawai SIA 
            $table->string('konselor_bidang',100);
            $table->text('konselor_keterangan');
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
        Schema::dropIfExists('konselors');
    }
}
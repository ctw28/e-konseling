<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('post_judul', 250);
            $table->string('post_slug', 300);
            $table->date('post_tanggal');
            $table->text('post_konten');
            $table->string('post_oleh', 50);
            $table->enum('post_status', ['publish','draft']);
            $table->enum('post_kategori', ['berita','psikoedukasi']);
            $table->string('post_foto', 100)->nullable();
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
        Schema::dropIfExists('posts');
    }
}
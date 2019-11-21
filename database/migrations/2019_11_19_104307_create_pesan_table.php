<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesan', function (Blueprint $table) {
            $table->increments('nomor');
            $table->unsignedInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users')->nullable()->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedInteger('nomor_meja');
            $table->foreign('nomor_meja')->references('nomor')->on('meja')->nullable()->onDelete('cascade')->onUpdate('cascade');
            $table->string('id_menu');
            $table->integer('total_harga');
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
        Schema::dropIfExists('pesan');
    }
}

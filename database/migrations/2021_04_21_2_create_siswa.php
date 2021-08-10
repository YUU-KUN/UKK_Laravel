<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiswa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->bigIncrements('nisn');
            $table->string('nis');
            $table->string('nama');
            $table->string('password');
            $table->unsignedBigInteger('id_kelas');
            $table->unsignedBigInteger('id_spp');
            $table->text('alamat');
            $table->string('no_telp');
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('id_spp')->references('id_spp')->on('spp');
            $table->foreign('id_kelas')->references('id_kelas')->on('kelas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('siswa');
    }
}

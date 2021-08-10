<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembayaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->bigIncrements('id_pembayaran');
            $table->unsignedBigInteger('id_petugas');
            $table->unsignedBigInteger('nisn');
            $table->unsignedBigInteger('id_spp');
            $table->integer('tgl_bayar');
            $table->string('bulan_dibayar');
            $table->string('tahun_dibayar');
            $table->integer('jumlah_bayar');
            $table->timestamps();

            $table->foreign('id_spp')->references('id_spp')->on('spp');
            $table->foreign('id_petugas')->references('id_petugas')->on('petugas');
            $table->foreign('nisn')->references('nisn')->on('siswa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembayaran');
    }
}

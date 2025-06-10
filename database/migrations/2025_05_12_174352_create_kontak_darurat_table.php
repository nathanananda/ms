<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKontakDaruratTable extends Migration
{
    public function up()
    {
        Schema::create('kontak_darurat', function (Blueprint $table) {
            $table->uuid('id_kontak_darurat')->primary();
            $table->uuid('id_karyawan');
            $table->string('nomor_kontak_darurat', 20);
            $table->string('hubungan_kontak_darurat', 50);
            $table->foreign('id_karyawan')->references('id_karyawan')->on('karyawan');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kontak_darurat');
    }
}
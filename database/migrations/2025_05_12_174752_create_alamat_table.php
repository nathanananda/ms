<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlamatTable extends Migration
{
    public function up()
    {
        Schema::create('alamat', function (Blueprint $table) {
            $table->uuid('id_alamat')->primary();
            $table->uuid('id_karyawan');
            $table->string('jenis_alamat', 20); // KTP or Domisili
            $table->text('alamat');
            $table->string('kodepos', 10);
            $table->uuid('id_kelurahan');
            $table->string('status_rumah', 50)->nullable();
            $table->foreign('id_karyawan')->references('id_karyawan')->on('karyawan');
            $table->foreign('id_kelurahan')->references('id_kelurahan')->on('master_kelurahan');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('alamat');
    }
}
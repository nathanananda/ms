<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTunjanganKaryawanTable extends Migration
{
    public function up()
    {
        Schema::create('tunjangan_karyawan', function (Blueprint $table) {
            $table->uuid('id_tunjangan_karyawan')->primary();
            $table->uuid('id_penggajian');
            $table->uuid('id_jenis_tunjangan');
            $table->foreign('id_penggajian')->references('id_penggajian')->on('penggajian');
            $table->foreign('id_jenis_tunjangan')->references('id_jenis_tunjangan')->on('jenis_tunjangan');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tunjangan_karyawan');
    }
}
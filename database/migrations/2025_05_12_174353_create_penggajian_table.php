<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenggajianTable extends Migration
{
    public function up()
    {
        Schema::create('penggajian', function (Blueprint $table) {
            $table->uuid('id_penggajian')->primary();
            $table->uuid('id_karyawan');
            $table->string('kode_golongan', 20);
            $table->string('npwp', 30)->nullable();
            $table->string('no_rekening', 30);
            $table->string('no_bpjs_kesehatan', 30)->nullable();
            $table->string('no_bpjs_ketenagakerjaan', 30)->nullable();
            $table->string('no_bpjs_pensiun', 30)->nullable();
            $table->foreign('id_karyawan')->references('id_karyawan')->on('karyawan');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('penggajian');
    }
}
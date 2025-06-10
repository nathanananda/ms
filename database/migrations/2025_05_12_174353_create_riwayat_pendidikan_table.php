<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiwayatPendidikanTable extends Migration
{
    public function up()
    {
        Schema::create('riwayat_pendidikan', function (Blueprint $table) {
            $table->uuid('id_riwayat_pendidikan')->primary();
            $table->uuid('id_karyawan');
            $table->string('tingkat_pendidikan', 50);
            $table->string('institusi', 150);
            $table->string('jurusan', 100)->nullable();
            $table->string('gelar', 50)->nullable();
            $table->integer('tahun_masuk');
            $table->integer('tahun_lulus')->nullable();
            $table->decimal('nilai', 5, 2)->nullable();
            $table->foreign('id_karyawan')->references('id_karyawan')->on('karyawan');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('riwayat_pendidikan');
    }
}
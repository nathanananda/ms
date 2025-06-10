<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKepegawaianTable extends Migration
{
    public function up()
    {
        Schema::create('kepegawaian', function (Blueprint $table) {
            $table->uuid('id_kepegawaian')->primary();
            $table->uuid('id_karyawan');
            $table->string('nik_karyawan', 20)->unique();
            $table->string('email_kantor', 100)->unique();
            $table->uuid('id_status_karyawan');
            $table->uuid('id_section');
            $table->uuid('id_jabatan');
            $table->string('dokumen_kontrak')->nullable();
            $table->uuid('atasan_langsung')->nullable();
            $table->date('tanggal_masuk');
            $table->date('tanggal_keluar')->nullable();
            $table->string('alasan_keluar')->nullable();
            $table->foreign('id_karyawan')->references('id_karyawan')->on('karyawan');
            $table->foreign('id_status_karyawan')->references('id_status_karyawan')->on('master_status_karyawan');
            $table->foreign('id_section')->references('id_section')->on('master_section');
            $table->foreign('id_jabatan')->references('id_jabatan')->on('master_jabatan');
            $table->foreign('atasan_langsung')->references('id_karyawan')->on('karyawan');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kepegawaian');
    }
}

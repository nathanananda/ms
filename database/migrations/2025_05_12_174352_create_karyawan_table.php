<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKaryawanTable extends Migration
{
    public function up()
    {
        Schema::create('karyawan', function (Blueprint $table) {
            $table->uuid('id_karyawan')->primary();
            $table->string('nama_lengkap', 150);
            $table->char('jenis_kelamin', 1)->nullable();
            $table->boolean('status_aktif')->default(true);
            $table->string('no_ktp', 20)->unique();
            $table->string('foto')->nullable();
            $table->string('no_hp', 20);
            $table->string('email_pribadi', 100)->nullable();
            $table->uuid('id_agama')->nullable();
            $table->string('status_nikah', 20)->nullable();
            $table->string('tempat_lahir', 100)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('golongan_darah', 3)->nullable();
            $table->integer('tinggi_badan')->nullable();
            $table->integer('berat_badan')->nullable();
            $table->string('kewarganegaraan', 4)->nullable();
            $table->foreign('id_agama')->references('id_agama')->on('master_agama');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('karyawan');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterKelurahanTable extends Migration
{
    public function up()
    {
        Schema::create('master_kelurahan', function (Blueprint $table) {
            $table->uuid('id_kelurahan')->primary();
            $table->string('nama_kelurahan', 100);
            $table->uuid('id_kecamatan');
            $table->foreign('id_kecamatan')->references('id_kecamatan')->on('master_kecamatan');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('master_kelurahan');
    }
}
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterKecamatanTable extends Migration
{
    public function up()
    {
        Schema::create('master_kecamatan', function (Blueprint $table) {
            $table->uuid('id_kecamatan')->primary();
            $table->string('nama_kecamatan', 100);
            $table->uuid('id_kota');
            $table->foreign('id_kota')->references('id_kota')->on('master_kota');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('master_kecamatan');
    }
}
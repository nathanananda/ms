<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterKotaTable extends Migration
{
    public function up()
    {
        Schema::create('master_kota', function (Blueprint $table) {
            $table->uuid('id_kota')->primary();
            $table->string('nama_kota', 100);
            $table->uuid('id_provinsi');
            $table->foreign('id_provinsi')->references('id_provinsi')->on('master_provinsi');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('master_kota');
    }
}
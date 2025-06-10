<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterDepartemenTable extends Migration
{
    public function up()
    {
        Schema::create('master_departemen', function (Blueprint $table) {
            $table->uuid('id_departemen')->primary();
            $table->string('kode_departemen', 20);
            $table->string('nama_departemen', 100);
            $table->uuid('id_divisi');
            $table->foreign('id_divisi')->references('id_divisi')->on('master_divisi');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('master_departemen');
    }
}
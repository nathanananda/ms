<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterSectionTable extends Migration
{
    public function up()
    {
        Schema::create('master_section', function (Blueprint $table) {
            $table->uuid('id_section')->primary();
            $table->string('kode_section', 20);
            $table->string('nama_section', 100);
            $table->uuid('id_departemen');
            $table->foreign('id_departemen')->references('id_departemen')->on('master_departemen');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('master_section');
    }
}
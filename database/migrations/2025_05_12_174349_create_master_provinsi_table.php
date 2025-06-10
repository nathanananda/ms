<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterProvinsiTable extends Migration
{
    public function up()
    {
        Schema::create('master_provinsi', function (Blueprint $table) {
            $table->uuid('id_provinsi')->primary();
            $table->string('nama_provinsi', 100);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('master_provinsi');
    }
}
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterDivisiTable extends Migration
{
    public function up()
    {
        Schema::create('master_divisi', function (Blueprint $table) {
            $table->uuid('id_divisi')->primary();
            $table->string('kode_divisi', 20);
            $table->string('nama_divisi', 100);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('master_divisi');
    }
}
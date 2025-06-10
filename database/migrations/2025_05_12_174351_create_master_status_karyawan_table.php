<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterStatusKaryawanTable extends Migration
{
    public function up()
    {
        Schema::create('master_status_karyawan', function (Blueprint $table) {
            $table->uuid('id_status_karyawan')->primary();
            $table->string('status_karyawan', 50);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('master_status_karyawan');
    }
}
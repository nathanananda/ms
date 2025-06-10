<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterJabatanTable extends Migration
{
    public function up()
    {
        Schema::create('master_jabatan', function (Blueprint $table) {
            $table->uuid('id_jabatan')->primary();
            $table->string('jabatan', 100);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('master_jabatan');
    }
}
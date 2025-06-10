<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterAgamaTable extends Migration
{
    public function up()
    {
        Schema::create('master_agama', function (Blueprint $table) {
            $table->uuid('id_agama')->primary();
            $table->string('agama', 50);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('master_agama');
    }
}
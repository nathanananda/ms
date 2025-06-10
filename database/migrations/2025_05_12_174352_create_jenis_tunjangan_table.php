<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJenisTunjanganTable extends Migration
{
    public function up()
    {
        Schema::create('jenis_tunjangan', function (Blueprint $table) {
            $table->uuid('id_jenis_tunjangan')->primary();
            $table->string('jenis_tunjangan', 100);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('jenis_tunjangan');
    }
}
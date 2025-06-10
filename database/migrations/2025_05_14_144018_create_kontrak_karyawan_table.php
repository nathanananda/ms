<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kontrak_karyawan', function (Blueprint $table) {
            $table->uuid();
            $table->uuid('id_karyawan');
            $table->date('awal_kontrak');
            $table->date('akhir_kontrak');
            $table->foreign('id_karyawan')->references('id_karyawan')->on('karyawan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kontrak_karyawan');
    }
};

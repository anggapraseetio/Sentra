<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('detail_pelapor', function (Blueprint $table) {
            $table->id('id_pelapor');
            $table->unsignedBigInteger('id_laporan');
            $table->string('nik', 100)->nullable();
            $table->string('nama', 150)->nullable();
            $table->string('alamat', 255)->nullable();
            $table->string('hubungan_dengan_korban', 100)->nullable();
            $table->string('no_telp', 15)->nullable();
            
            $table->foreign('id_laporan')->references('id_laporan')->on('laporan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_pelapor');
    }
};

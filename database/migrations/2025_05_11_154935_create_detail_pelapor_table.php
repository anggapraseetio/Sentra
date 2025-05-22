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
            $table->string('id_laporan', 50);
            $table->string('nik', 255)->nullable();
            $table->string('nama', 150)->nullable();
            $table->string('alamat', 255)->nullable();
            $table->string('hubungan_dengan_korban', 100)->nullable();
            $table->string('no_telp', 255)->nullable();
            
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

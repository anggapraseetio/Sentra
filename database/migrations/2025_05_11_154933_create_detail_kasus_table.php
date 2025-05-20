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
        Schema::create('detail_kasus', function (Blueprint $table) {
            $table->id('id_kasus');
            $table->string('id_laporan', 50);
            $table->date('tanggal')->nullable();
            $table->string('tempat_kejadian', 150)->nullable();
            $table->text('kronologi')->nullable();
            
            $table->foreign('id_laporan')->references('id_laporan')->on('laporan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_kasus');
    }
};

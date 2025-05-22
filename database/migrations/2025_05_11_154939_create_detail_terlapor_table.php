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
        Schema::create('detail_terlapor', function (Blueprint $table) {
            $table->id('id_terlapor');
            $table->string('id_laporan', 50);
            $table->string('nik', 255)->nullable();
            $table->string('nama', 100)->nullable();
            $table->integer('umur')->nullable();
            $table->text('alamat')->nullable();
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan'])->nullable();
            $table->string('hubungan_dengan_korban', 100)->nullable();
            $table->string('informasi_tambahan', 255)->nullable();
            
            $table->foreign('id_laporan')->references('id_laporan')->on('laporan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_terlapor');
    }
};

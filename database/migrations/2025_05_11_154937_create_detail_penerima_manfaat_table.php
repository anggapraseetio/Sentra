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
        Schema::create('detail_penerima_manfaat', function (Blueprint $table) {
            $table->id('id_penerima');
            $table->string('id_laporan', 50);
            $table->string('nik', 255)->nullable();
            $table->string('nama', 100)->nullable();
            $table->string('tempat_lahir', 100)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->integer('umur')->nullable();
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan'])->nullable();
            $table->string('pekerjaan', 100)->nullable();
            $table->enum('agama', ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu', 'Lainnya'])->nullable();
            $table->text('alamat')->nullable();
            $table->enum('pendidikan', ['Tidak Sekolah', 'SD', 'SMP', 'SMA', 'Diploma', 'S1', 'S2', 'S3', 'Lainnya'])->nullable();
            $table->string('hubungan_dengan_terlapor', 100)->nullable();
            $table->string('notelp', 255)->nullable();
            $table->text('informasi_tambahan')->nullable();
            
            $table->foreign('id_laporan')->references('id_laporan')->on('laporan')->onDelete('cascade');
        });
        
        // Note: In Laravel, calculating age would typically be handled through model events
        // rather than database triggers
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_penerima_manfaat');
    }
};

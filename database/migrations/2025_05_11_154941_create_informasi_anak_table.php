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
        Schema::create('informasi_anak', function (Blueprint $table) {
            $table->id('id_anak');
            $table->unsignedBigInteger('id_penerima');
            $table->string('nama', 100)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->integer('umur')->nullable();
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan'])->nullable();
            $table->enum('pendidikan', ['Tidak Sekolah', 'PAUD', 'TK', 'SD', 'SMP', 'SMA', 'Lainnya'])->nullable();
            $table->enum('agama', ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu', 'Lainnya'])->nullable();
            $table->enum('status', ['Anak Kandung', 'Anak Angkat'])->nullable();
            
            $table->foreign('id_penerima')->references('id_penerima')->on('detail_penerima_manfaat')->onDelete('cascade');
        });
        
    }

    public function down(): void
    {
        Schema::dropIfExists('informasi_anak');
    }
};

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
        Schema::create('laporan', function (Blueprint $table) {
            $table->string('id_laporan', 50)->primary();
            $table->unsignedBigInteger('id_akun');
            $table->enum('kategori', [
                'Kekerasan Fisik', 
                'Kekerasan Psikis', 
                'Kekerasan Seksual', 
                'Penelantaran', 
                'Eksploitasi', 
                'TPPO', 
                'Lainnya', 
                'unset'
            ])->default('unset');
            $table->enum('status', ['dikirim', 'diterima', 'diproses', 'selesai'])->default('dikirim');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            
            $table->foreign('id_akun')->references('id_akun')->on('akun')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan');
    }
};

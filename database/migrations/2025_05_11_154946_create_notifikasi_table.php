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
        Schema::create('notifikasi', function (Blueprint $table) {
            $table->id('id_notif');
            $table->unsignedBigInteger('id_akun');
            $table->string('judul', 100);
            $table->string('pesan', 255);
            $table->enum('tipe', ['admin', 'user']);
            $table->enum('status', ['terkirim', 'dibaca'])->default('terkirim');
            $table->timestamp('created_at')->useCurrent();
            
            $table->foreign('id_akun')->references('id_akun')->on('akun')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifikasi');
    }
};

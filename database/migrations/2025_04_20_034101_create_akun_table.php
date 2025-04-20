<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('akun', function (Blueprint $table) {
            $table->increments('id_akun');
            $table->string('notelp', 15)->nullable();;
            $table->string('nama', 50);
            $table->string('email', 100)->nullable();
            $table->string('password', 100);
            $table->enum('role', ['user', 'admin', 'guest'])->default('guest');
            $table->enum('emerquest', ['Apa warna Favorit Anda?', 'Apa Hewan Favorit Anda?'])->nullable();
            $table->string('answquest', 100)->nullable();
            $table->string('otp', 10)->nullable();
            $table->dateTime('otp_expiry')->nullable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('akun');
    }
};

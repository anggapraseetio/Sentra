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
        Schema::create('akun', function (Blueprint $table) {
            $table->id('id_akun');
            $table->string('notelp', 15); 
            $table->string('nama', 50); 
            $table->string('email', 100)->unique()->nullable();
            $table->enum('jenis_kelamin', ['Pria', 'Wanita'])->nullable(); 
            $table->string('alamat', 255)->nullable();
            $table->string('password', 255);
            $table->enum('role', ['user', 'admin', 'guest'])->default('guest');
            $table->enum('emerquest', [
                'Apa Warna Favorit anda ?',
                'Apa Hewan Favorit anda ?',
                'Dimana anda Lahir ?'
            ])->nullable(); 
            $table->string('answquest', 100)->nullable();
            $table->string('otp', 10)->nullable();
            $table->dateTime('otp_expiry')->nullable(); 
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
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

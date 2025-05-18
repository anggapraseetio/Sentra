<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasColumn('akun', 'fcm_token')) {
            Schema::table('akun', function (Blueprint $table) {
                $table->string('fcm_token')->nullable()->after('otp_expiry');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('akun', function (Blueprint $table) {
            //
        });
    }
};

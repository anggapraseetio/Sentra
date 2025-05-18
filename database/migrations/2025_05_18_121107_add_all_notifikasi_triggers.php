<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Trigger after_chat_insert
        DB::unprepared('
            CREATE TRIGGER `after_chat_insert` 
            AFTER INSERT ON `chats` 
            FOR EACH ROW 
            BEGIN
                INSERT INTO notifikasi (id_akun, judul, pesan, tipe, status, created_at)
                VALUES (
                    NEW.receiver_id,
                    "Pesan Baru",
                    CONCAT("Anda menerima pesan baru dari ", 
                           (SELECT nama FROM akun WHERE id_akun = NEW.sender_id), 
                           ": ", NEW.message),
                    "user",
                    "terkirim",
                    NOW()
                );
            END
        ');

        // Trigger after_laporan_insert_admin
        DB::unprepared('
            CREATE TRIGGER `after_laporan_insert_admin` 
            AFTER INSERT ON `laporan` 
            FOR EACH ROW 
            BEGIN
                INSERT INTO notifikasi (id_akun, judul, pesan, tipe, status, created_at)
                SELECT 
                    id_akun,
                    CONCAT(NEW.id_laporan, " - Laporan Baru"),
                    CONCAT("Laporan baru dengan ID ", NEW.id_laporan, " telah dibuat oleh ",
                           (SELECT nama FROM akun WHERE id_akun = NEW.id_akun)),
                    "admin",
                    "terkirim",
                    NOW()
                FROM akun
                WHERE id_akun = 1;
            END
        ');

        // Trigger after_laporan_insert_user
        DB::unprepared('
            CREATE TRIGGER `after_laporan_insert_user` 
            AFTER INSERT ON `laporan` 
            FOR EACH ROW 
            BEGIN
                INSERT INTO notifikasi (id_akun, judul, pesan, tipe, status, created_at)
                VALUES (
                    NEW.id_akun,
                    CONCAT(NEW.id_laporan, " - Laporan Terkirim"),
                    CONCAT("Laporan Anda dengan ID ", NEW.id_laporan, " telah berhasil dikirim dan sedang menunggu verifikasi."),
                    "user",
                    "terkirim",
                    NOW()
                );
            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS `after_chat_insert`');
        DB::unprepared('DROP TRIGGER IF EXISTS `after_laporan_insert_admin`');
        DB::unprepared('DROP TRIGGER IF EXISTS `after_laporan_insert_user`');
    }
};


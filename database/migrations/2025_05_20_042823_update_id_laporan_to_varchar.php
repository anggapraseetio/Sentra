<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UpdateIdLaporanToVarchar extends Migration
{
    public function up()
    {
        // Langkah 1: Nonaktifkan pemeriksaan foreign key
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');

        // Langkah 2: Hapus AUTO_INCREMENT dari id_laporan di tabel laporan
        Schema::table('laporan', function (Blueprint $table) {
            $table->bigInteger('id_laporan')->unsigned()->change();
        });

        // Langkah 3: Ubah tipe data id_laporan ke VARCHAR(50) dengan collation utf8mb4_unicode_ci
        Schema::table('laporan', function (Blueprint $table) {
            $table->string('id_laporan', 50)->collation('utf8mb4_unicode_ci')->change();
        });

        Schema::table('detail_kasus', function (Blueprint $table) {
            $table->string('id_laporan', 50)->collation('utf8mb4_unicode_ci')->change();
        });

        Schema::table('detail_pelapor', function (Blueprint $table) {
            $table->string('id_laporan', 50)->collation('utf8mb4_unicode_ci')->change();
        });

        Schema::table('detail_penerima_manfaat', function (Blueprint $table) {
            $table->string('id_laporan', 50)->collation('utf8mb4_unicode_ci')->change();
        });

        Schema::table('detail_terlapor', function (Blueprint $table) {
            $table->string('id_laporan', 50)->collation('utf8mb4_unicode_ci')->change();
        });


        // Langkah 4: Update data existing ke format RKN<nomor>
        DB::statement("UPDATE `laporan` SET `id_laporan` = CONCAT('RKN', LPAD(id_laporan, 6, '0')) WHERE `id_laporan` NOT LIKE 'RKN%';");
        DB::statement("UPDATE `detail_kasus` SET `id_laporan` = CONCAT('RKN', LPAD(id_laporan, 6, '0')) WHERE `id_laporan` NOT LIKE 'RKN%';");
        DB::statement("UPDATE `detail_pelapor` SET `id_laporan` = CONCAT('RKN', LPAD(id_laporan, 6, '0')) WHERE `id_laporan` NOT LIKE 'RKN%';");
        DB::statement("UPDATE `detail_penerima_manfaat` SET `id_laporan` = CONCAT('RKN', LPAD(id_laporan, 6, '0')) WHERE `id_laporan` NOT LIKE 'RKN%';");
        DB::statement("UPDATE `detail_terlapor` SET `id_laporan` = CONCAT('RKN', LPAD(id_laporan, 6, '0')) WHERE `id_laporan` NOT LIKE 'RKN%';");

        // Langkah 5: Aktifkan kembali pemeriksaan foreign key
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

        // Langkah 6: Buat ulang trigger dengan collation yang konsisten
        DB::statement('DROP TRIGGER IF EXISTS `before_laporan_insert_id`;');

        DB::statement(<<<SQL
        CREATE TRIGGER `before_laporan_insert_id` BEFORE INSERT ON `laporan`
        FOR EACH ROW
        BEGIN
            DECLARE timestamp_code BIGINT;
            DECLARE random_suffix INT;
            DECLARE new_kode VARCHAR(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

            -- Ambil UNIX timestamp (detik sejak epoch) dan konversi ke format 6 digit terakhir
            SET timestamp_code = UNIX_TIMESTAMP() % 1000000;

            -- Tambahkan nomor acak 3 digit untuk tambahan keunikan
            SET random_suffix = FLOOR(100 + RAND() * 900);

            -- Format kode: RKNtimestamp_random
            SET new_kode = CONCAT('RKN', timestamp_code, random_suffix);

            -- Pastikan kode unik
            WHILE EXISTS (SELECT 1 FROM `laporan` WHERE `id_laporan` = new_kode) DO
                SET random_suffix = FLOOR(100 + RAND() * 900);
                SET new_kode = CONCAT('RKN', timestamp_code, random_suffix);
            END WHILE;

            -- Set nilai id_laporan
            SET NEW.id_laporan = new_kode;
        END
        SQL
        );

    }

    public function down()
    {
        // Langkah 1: Nonaktifkan pemeriksaan foreign key
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');

        // Langkah 2: Hapus trigger
        DB::statement('DROP TRIGGER IF EXISTS `before_laporan_insert_id`;');

        // Langkah 3: Kembalikan id_laporan ke BIGINT dan tambahkan AUTO_INCREMENT
        Schema::table('laporan', function (Blueprint $table) {
            $table->bigIncrements('id_laporan')->change();
        });

        Schema::table('detail_kasus', function (Blueprint $table) {
            $table->bigInteger('id_laporan')->unsigned()->change();
        });

        Schema::table('detail_pelapor', function (Blueprint $table) {
            $table->bigInteger('id_laporan')->unsigned()->change();
        });

        Schema::table('detail_penerima_manfaat', function (Blueprint $table) {
            $table->bigInteger('id_laporan')->unsigned()->change();
        });

        Schema::table('detail_terlapor', function (Blueprint $table) {
            $table->bigInteger('id_laporan')->unsigned()->change();
        });

        // Langkah 4: Kembalikan data ke format numerik (hapus RKN dan padding)
        DB::statement("UPDATE `laporan` SET `id_laporan` = CAST(SUBSTRING(`id_laporan`, 5) AS UNSIGNED) WHERE `id_laporan` LIKE 'RKN%';");
        DB::statement("UPDATE `detail_kasus` SET `id_laporan` = CAST(SUBSTRING(`id_laporan`, 5) AS UNSIGNED) WHERE `id_laporan` LIKE 'RKN%';");
        DB::statement("UPDATE `detail_pelapor` SET `id_laporan` = CAST(SUBSTRING(`id_laporan`, 5) AS UNSIGNED) WHERE `id_laporan` LIKE 'RKN%';");
        DB::statement("UPDATE `detail_penerima_manfaat` SET `id_laporan` = CAST(SUBSTRING(`id_laporan`, 5) AS UNSIGNED) WHERE `id_laporan` LIKE 'RKN%';");
        DB::statement("UPDATE `detail_terlapor` SET `id_laporan` = CAST(SUBSTRING(`id_laporan`, 5) AS UNSIGNED) WHERE `id_laporan` LIKE 'RKN%';");
        // Langkah 5: Aktifkan kembali pemeriksaan foreign key
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}

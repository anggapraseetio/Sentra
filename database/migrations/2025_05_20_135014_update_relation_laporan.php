<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Langkah 1: Nonaktifkan pemeriksaan foreign key
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');

        // Langkah 2: Hapus foreign key constraints yang sudah ada (jika ada)
        $this->dropForeignKeyIfExists('detail_kasus', 'detail_kasus_id_laporan_foreign');
        $this->dropForeignKeyIfExists('detail_pelapor', 'detail_pelapor_id_laporan_foreign');
        $this->dropForeignKeyIfExists('detail_penerima_manfaat', 'detail_penerima_manfaat_id_laporan_foreign');
        $this->dropForeignKeyIfExists('detail_terlapor', 'detail_terlapor_id_laporan_foreign');

        // Langkah 3: Tambahkan foreign key constraints
        Schema::table('detail_kasus', function (Blueprint $table) {
            $table->foreign('id_laporan')
                  ->references('id_laporan')
                  ->on('laporan')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });

        Schema::table('detail_pelapor', function (Blueprint $table) {
            $table->foreign('id_laporan')
                  ->references('id_laporan')
                  ->on('laporan')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });

        Schema::table('detail_penerima_manfaat', function (Blueprint $table) {
            $table->foreign('id_laporan')
                  ->references('id_laporan')
                  ->on('laporan')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });

        Schema::table('detail_terlapor', function (Blueprint $table) {
            $table->foreign('id_laporan')
                  ->references('id_laporan')
                  ->on('laporan')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });

        // Langkah 4: Aktifkan kembali pemeriksaan foreign key
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }

    public function down()
    {
        // Langkah 1: Nonaktifkan pemeriksaan foreign key
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');

        // Langkah 2: Hapus foreign key constraints
        Schema::table('detail_kasus', function (Blueprint $table) {
            $table->dropForeign(['id_laporan']);
        });

        Schema::table('detail_pelapor', function (Blueprint $table) {
            $table->dropForeign(['id_laporan']);
        });

        Schema::table('detail_penerima_manfaat', function (Blueprint $table) {
            $table->dropForeign(['id_laporan']);
        });

        Schema::table('detail_terlapor', function (Blueprint $table) {
            $table->dropForeign(['id_laporan']);
        });

        // Langkah 3: Aktifkan kembali pemeriksaan foreign key
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }

    /**
     * Helper untuk menghapus foreign key jika ada
     *
     * @param string $table
     * @param string $foreignKey
     * @return void
     */
    private function dropForeignKeyIfExists($table, $foreignKey)
    {
        try {
            Schema::table($table, function (Blueprint $table) use ($foreignKey) {
                $table->dropForeign($foreignKey);
            });
        } catch (\Exception $e) {
            // Abaikan jika foreign key tidak ada
        }
    }
};
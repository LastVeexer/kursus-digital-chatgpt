<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddJamMulaiAndJamSelesaiToKursusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kursus', function (Blueprint $table) {
            // Menambahkan kolom 'jam_mulai' dan 'jam_selesai' ke tabel kursus
            $table->time('jam_mulai')->nullable()->after('hari');
            $table->time('jam_selesai')->nullable()->after('jam_mulai');
            $table->integer('durasi')->nullable()->change(); // Pastikan kolom durasi tetap ada dan bisa diisi secara otomatis
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kursus', function (Blueprint $table) {
            // Menghapus kolom 'jam_mulai' dan 'jam_selesai' jika migrasi dibatalkan
            $table->dropColumn('jam_mulai');
            $table->dropColumn('jam_selesai');
        });
    }
}

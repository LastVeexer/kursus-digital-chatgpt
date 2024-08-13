<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyKursusTableForMultipleDaysAndHours extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kursus', function (Blueprint $table) {
            // Mengubah kolom 'jadwal' menjadi 'hari' dan 'jam' dengan tipe TEXT
            $table->text('hari')->nullable()->after('deskripsi'); // Kolom 'hari' untuk menyimpan array hari
            $table->text('jam')->nullable()->after('hari'); // Kolom 'jam' untuk menyimpan array jam
            $table->dropColumn('jadwal'); // Menghapus kolom 'jadwal'
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
            // Mengembalikan perubahan jika dilakukan rollback
            $table->string('jadwal')->after('deskripsi'); // Mengembalikan kolom 'jadwal'
            $table->dropColumn('hari'); // Menghapus kolom 'hari'
            $table->dropColumn('jam'); // Menghapus kolom 'jam'
        });
    }
}

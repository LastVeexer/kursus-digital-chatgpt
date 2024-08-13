<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKursusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Membuat tabel 'kursus' di database
        Schema::create('kursus', function (Blueprint $table) {
            $table->id(); // Kolom 'id' sebagai primary key dengan auto increment
            $table->string('nama_kursus'); // Kolom 'nama_kursus' untuk menyimpan nama kursus
            $table->text('deskripsi'); // Kolom 'deskripsi' untuk menyimpan deskripsi kursus
            $table->string('jadwal'); // Kolom 'jadwal' untuk menyimpan jadwal kursus
            $table->integer('durasi'); // Kolom 'durasi' untuk menyimpan durasi kursus dalam jam
            $table->string('instruktur'); // Kolom 'instruktur' untuk menyimpan nama instruktur kursus
            $table->timestamps(); // Kolom 'created_at' dan 'updated_at' otomatis diisi oleh Laravel
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Menghapus tabel 'kursus' jika rollback migration dilakukan
        Schema::dropIfExists('kursus');
    }
}

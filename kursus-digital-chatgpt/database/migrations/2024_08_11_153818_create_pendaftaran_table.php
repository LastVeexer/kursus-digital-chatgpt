<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendaftaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Membuat tabel 'pendaftaran' di database
        Schema::create('pendaftaran', function (Blueprint $table) {
            $table->id(); // Kolom 'id' sebagai primary key dengan auto increment
            $table->foreignId('siswa_id')->constrained('siswa')->onDelete('cascade'); // Kolom 'siswa_id' sebagai foreign key dari tabel 'siswa', dengan aturan cascade delete
            $table->foreignId('kursus_id')->constrained('kursus')->onDelete('cascade'); // Kolom 'kursus_id' sebagai foreign key dari tabel 'kursus', dengan aturan cascade delete
            $table->date('tanggal_pendaftaran'); // Kolom 'tanggal_pendaftaran' untuk menyimpan tanggal pendaftaran siswa ke kursus
            $table->string('status'); // Kolom 'status' untuk menyimpan status pendaftaran, misalnya: 'terdaftar' atau 'selesai'
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
        // Menghapus tabel 'pendaftaran' jika rollback migration dilakukan
        Schema::dropIfExists('pendaftaran');
    }
}

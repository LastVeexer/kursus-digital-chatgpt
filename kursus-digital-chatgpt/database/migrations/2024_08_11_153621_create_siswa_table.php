<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Membuat tabel 'siswa' di database
        Schema::create('siswa', function (Blueprint $table) {
            $table->id(); // Kolom 'id' sebagai primary key dengan auto increment
            $table->string('nama'); // Kolom 'nama' untuk menyimpan nama lengkap siswa
            $table->string('email')->unique(); // Kolom 'email' yang harus unik
            $table->string('no_telepon'); // Kolom 'no_telepon' untuk menyimpan nomor telepon siswa
            $table->text('alamat'); // Kolom 'alamat' untuk menyimpan alamat siswa
            $table->date('tanggal_lahir'); // Kolom 'tanggal_lahir' untuk menyimpan tanggal lahir siswa
            $table->string('kelas'); // Kolom 'kelas' untuk menyimpan kelas siswa
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
        // Menghapus tabel 'siswa' jika rollback migration dilakukan
        Schema::dropIfExists('siswa');
    }
}

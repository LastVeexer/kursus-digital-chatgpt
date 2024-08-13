<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kursus;

class KursusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kursus::create([
            'nama_kursus' => 'Kursus Pemrograman Web',
            'deskripsi' => 'Belajar dasar-dasar pemrograman web menggunakan HTML, CSS, dan JavaScript.',
            'hari' => ['Senin', 'Rabu'],
            'jam_mulai' => '10:00:00',
            'jam_selesai' => '12:00:00',
            'durasi' => 2,
            'instruktur' => 'Budi Santoso'
        ]);

        Kursus::create([
            'nama_kursus' => 'Kursus Desain Grafis',
            'deskripsi' => 'Menguasai teknik dasar desain grafis dengan menggunakan Adobe Photoshop dan Illustrator.',
            'hari' => ['Selasa', 'Kamis'],
            'jam_mulai' => '09:00:00',
            'jam_selesai' => '11:00:00',
            'durasi' => 2,
            'instruktur' => 'Sinta Dewi'
        ]);

        Kursus::create([
            'nama_kursus' => 'Kursus Data Science',
            'deskripsi' => 'Pelajari dasar-dasar Data Science, dari pengumpulan data hingga analisis data menggunakan Python.',
            'hari' => ['Jumat'],
            'jam_mulai' => '13:00:00',
            'jam_selesai' => '15:00:00',
            'durasi' => 2,
            'instruktur' => 'Andi Firmansyah'
        ]);

        Kursus::create([
            'nama_kursus' => 'Kursus Bahasa Inggris',
            'deskripsi' => 'Meningkatkan kemampuan berbahasa Inggris dengan metode pembelajaran interaktif.',
            'hari' => ['Senin', 'Rabu', 'Jumat'],
            'jam_mulai' => '08:00:00',
            'jam_selesai' => '10:00:00',
            'durasi' => 2,
            'instruktur' => 'Ratna Sari'
        ]);

        Kursus::create([
            'nama_kursus' => 'Kursus Fotografi',
            'deskripsi' => 'Belajar teknik dasar dan lanjutan fotografi menggunakan kamera DSLR.',
            'hari' => ['Sabtu', 'Minggu'],
            'jam_mulai' => '14:00:00',
            'jam_selesai' => '16:00:00',
            'durasi' => 2,
            'instruktur' => 'Gilang Pratama'
        ]);

        Kursus::create([
            'nama_kursus' => 'Kursus Pengembangan Android',
            'deskripsi' => 'Membuat aplikasi Android dengan menggunakan Kotlin dan Android Studio.',
            'hari' => ['Senin', 'Kamis'],
            'jam_mulai' => '10:00:00',
            'jam_selesai' => '12:00:00',
            'durasi' => 2,
            'instruktur' => 'Indra Wijaya'
        ]);

        Kursus::create([
            'nama_kursus' => 'Kursus Manajemen Proyek TI',
            'deskripsi' => 'Mempelajari teknik manajemen proyek dalam pengembangan software dan IT.',
            'hari' => ['Selasa', 'Kamis'],
            'jam_mulai' => '13:00:00',
            'jam_selesai' => '15:00:00',
            'durasi' => 2,
            'instruktur' => 'Dewi Lestari'
        ]);

        Kursus::create([
            'nama_kursus' => 'Kursus Jaringan Komputer',
            'deskripsi' => 'Pelajari dasar-dasar jaringan komputer dan pengaturannya.',
            'hari' => ['Rabu', 'Jumat'],
            'jam_mulai' => '09:00:00',
            'jam_selesai' => '11:00:00',
            'durasi' => 2,
            'instruktur' => 'Yudi Setiawan'
        ]);

        Kursus::create([
            'nama_kursus' => 'Kursus Keamanan Siber',
            'deskripsi' => 'Menguasai dasar-dasar keamanan siber dan cara melindungi data.',
            'hari' => ['Kamis'],
            'jam_mulai' => '10:00:00',
            'jam_selesai' => '12:00:00',
            'durasi' => 2,
            'instruktur' => 'Agus Rahman'
        ]);

        Kursus::create([
            'nama_kursus' => 'Kursus Pemasaran Digital',
            'deskripsi' => 'Pelajari teknik-teknik pemasaran digital untuk meningkatkan penjualan online.',
            'hari' => ['Senin', 'Kamis'],
            'jam_mulai' => '14:00:00',
            'jam_selesai' => '16:00:00',
            'durasi' => 2,
            'instruktur' => 'Siti Nurhaliza'
        ]);
    }
}

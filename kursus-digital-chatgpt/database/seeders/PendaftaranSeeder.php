<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pendaftaran;
use App\Models\Siswa;
use App\Models\Kursus;
use Faker\Factory as Faker;

class PendaftaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Ambil semua siswa dan kursus yang ada di database
        $siswaList = Siswa::all();
        $kursusList = Kursus::all();

        // Pastikan ada data siswa dan kursus untuk dihubungkan
        if ($siswaList->isEmpty() || $kursusList->isEmpty()) {
            $this->command->info('Tidak ada data siswa atau kursus untuk dihubungkan.');
            return;
        }

        // Generate 30 data pendaftaran dengan status yang valid
        for ($i = 0; $i < 30; $i++) {
            Pendaftaran::create([
                'siswa_id' => $siswaList->random()->id,
                'kursus_id' => $kursusList->random()->id,
                'tanggal_pendaftaran' => $faker->dateTimeBetween('-1 years', 'now')->format('Y-m-d'),
                'status' => $faker->randomElement(['sedang berlangsung', 'selesai']),
            ]);
        }
    }
}

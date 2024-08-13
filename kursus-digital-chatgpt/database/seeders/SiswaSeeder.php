<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Siswa;
use Faker\Factory as Faker;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 20; $i++) {
            Siswa::create([
                'nama' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'no_telepon' => $faker->phoneNumber,
                'alamat' => $faker->address,
                'tanggal_lahir' => $faker->date($format = 'Y-m-d', $max = '2005-12-31'),
                'kelas' => $faker->randomElement(['Reguler', 'VIP']),
            ]);
        }
    }
}

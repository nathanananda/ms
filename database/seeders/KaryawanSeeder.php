<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Carbon\Carbon;

class KaryawanSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $agamaIds = DB::table('master_agama')->pluck('id_agama')->toArray();

        for ($i = 0; $i < 20; $i++) {
            DB::table('karyawan')->insert([
                'id_karyawan' => Str::uuid(),
                'nama_lengkap' => $faker->name(),
                'jenis_kelamin' => $faker->randomElement(['L', 'P']),
                'status_aktif' => $faker->boolean(),
                'no_ktp' => $faker->nik(),
                'foto' => '',
                'no_hp' => $faker->phoneNumber(),
                'email_pribadi' => $faker->unique()->safeEmail(),
                'id_agama' => $faker->randomElement($agamaIds),
                'status_nikah' => $faker->randomElement(['Belum Menikah', 'Menikah', 'Cerai']),
                'tempat_lahir' => $faker->city(),
                'tanggal_lahir' => $faker->date('Y-m-d', '-20 years'),
                'golongan_darah' => $faker->randomElement(['A', 'B', 'AB', 'O']),
                'tinggi_badan' => $faker->numberBetween(150, 180),
                'berat_badan' => $faker->numberBetween(45, 90),
                'kewarganegaraan' => $faker->randomElement(['WNI', 'WNA']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => null,
            ]);
        }
    }
}

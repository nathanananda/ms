<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class PendidikanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Ambil semua id_karyawan dari tabel karyawan
        $karyawanIds = \App\Models\Karyawan::pluck('id_karyawan')->toArray();

        if (empty($karyawanIds)) {
            $this->command->warn("Tidak ada data karyawan ditemukan.");
            return;
        }

        foreach (range(1, 20) as $i) {
            DB::table('riwayat_pendidikan')->insert([
                'id_riwayat_pendidikan' => Str::uuid(),
                'id_karyawan' => $faker->randomElement($karyawanIds),
                'tingkat_pendidikan' => $faker->randomElement(['SMA', 'D3', 'S1', 'S2']),
                'institusi' => $faker->company . ' University',
                'jurusan' => $faker->randomElement(['Teknik Informatika', 'Manajemen', 'Akuntansi', 'Kedokteran']),
                'gelar' => $faker->randomElement(['S.Kom', 'S.E', 'M.Kom', 'Dr.']),
                'tahun_masuk' => $faker->numberBetween(2005, 2015),
                'tahun_lulus' => $faker->numberBetween(2016, 2022),
                'nilai' => $faker->randomFloat(2, 2.5, 4.0),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => null
            ]);
        }
    }
}

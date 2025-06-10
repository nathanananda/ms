<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class KontakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Ambil semua ID karyawan dari tabel karyawan
        $karyawanIds = \App\Models\Karyawan::pluck('id_karyawan')->toArray();

        if (empty($karyawanIds)) {
            $this->command->warn("Tidak ada data karyawan ditemukan.");
            return;
        }

        foreach ($karyawanIds as $idKaryawan) {
            DB::table('kontak_darurat')->insert([
                'id_kontak_darurat' => Str::uuid(),
                'id_karyawan' => $idKaryawan,
                'nomor_kontak_darurat' => $faker->phoneNumber(),
                'hubungan_kontak_darurat' => $faker->randomElement(['Istri', 'Suami', 'Anak', 'Orang Tua', 'Saudara']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => null,
            ]);
        }
    }
}

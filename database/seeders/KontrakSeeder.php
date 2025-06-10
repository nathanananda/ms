<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use Carbon\Carbon;

class KontrakSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Ambil semua id_karyawan
        $karyawanIds = \App\Models\Karyawan::pluck('id_karyawan')->toArray();

        if (empty($karyawanIds)) {
            $this->command->warn("Tidak ada data karyawan ditemukan.");
            return;
        }

        foreach ($karyawanIds as $a) {
            $tanggalMulai = $faker->dateTimeBetween('-2 years', 'now');
            $tanggalBerakhir = (clone $tanggalMulai)->modify('+1 year');

            DB::table('kontrak_karyawan')->insert([
                'uuid' => Str::uuid(),
                'id_karyawan' => $a,
                'awal_kontrak' => $tanggalMulai->format('Y-m-d'),
                'akhir_kontrak' => $tanggalBerakhir->format('Y-m-d'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}

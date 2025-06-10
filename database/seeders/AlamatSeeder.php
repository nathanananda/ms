<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use Faker\Factory as Faker;


class AlamatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Ambil semua ID karyawan dan kelurahan
        $karyawanIds = \App\Models\Karyawan::pluck('id_karyawan')->toArray();
        $kelurahanIds = DB::table('master_kelurahan')->pluck('id_kelurahan')->toArray();

        if (empty($karyawanIds) || empty($kelurahanIds)) {
            $this->command->warn("Tidak ada data karyawan atau kelurahan ditemukan.");
            return;
        }

        foreach ($karyawanIds as $idKaryawan) {
            DB::table('alamat')->insert([
                'id_alamat' => Str::uuid(),
                'id_karyawan' => $idKaryawan,
                'jenis_alamat' => $faker->randomElement(['Domisili', 'KTP']),
                'alamat' => $faker->address(),
                'kodepos' => $faker->postcode(),
                'id_kelurahan' => $faker->randomElement($kelurahanIds),
                'status_rumah' => $faker->randomElement(['Milik Sendiri', 'Sewa', 'Kontrak', 'Menumpang']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => null,
            ]);
        }
    }
}

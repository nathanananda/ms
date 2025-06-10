<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class PenggajianSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Ambil semua data karyawan
        $karyawans = DB::table('karyawan')->select('id_karyawan')->get();

        if ($karyawans->isEmpty()) {
            $this->command->error('Data karyawan tidak ditemukan!');
            return;
        }

        $kodeGolonganOptions = ['A1', 'B1', 'B2', 'C1', 'C2', 'C3', 'D1'];

        foreach ($karyawans as $karyawan) {
            DB::table('penggajian')->insert([
                'id_penggajian' => (string) Str::uuid(),
                'id_karyawan' => $karyawan->id_karyawan,
                'kode_golongan' => $faker->randomElement($kodeGolonganOptions),
                'npwp' => $faker->regexify('[0-9]{2}\.[0-9]{3}\.[0-9]{3}\.[0-9]{1}-[0-9]{3}\.[0-9]{1}'),
                'no_rekening' => $faker->bankAccountNumber(),
                'no_bpjs_kesehatan' => $faker->numerify('###########'),
                'no_bpjs_ketenagakerjaan' => $faker->numerify('###########'),
                'no_bpjs_pensiun' => $faker->numerify('###########'),
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ]);
        }

        $this->command->info('Seeder penggajian selesai, data dibuat berdasarkan data karyawan.');
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use Carbon\Carbon;

class KepegawaianSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Ambil semua id dari tabel referensi
        $karyawanIds = \App\Models\Karyawan::pluck('id_karyawan')->toArray();
        $statusIds   = DB::table('master_status_karyawan')->pluck('id_status_karyawan')->toArray();
        $sectionIds  = DB::table('master_section')->pluck('id_section')->toArray();
        $jabatanIds  = DB::table('master_jabatan')->pluck('id_jabatan')->toArray();

        if (empty($karyawanIds) || empty($statusIds) || empty($sectionIds) || empty($jabatanIds)) {
            $this->command->warn('Data master (karyawan, status, section, jabatan) belum tersedia.');
            return;
        }

        foreach ($karyawanIds as $idKaryawan) {
            // Ambil atasan secara acak selain dirinya sendiri
            $atasanLangsung = collect($karyawanIds)
                ->reject(fn($id) => $id === $idKaryawan)
                ->random();

            $tanggalMasuk = $faker->dateTimeBetween('-5 years', 'now');
            $alasanKeluar = $faker->boolean(20) ? $faker->randomElement(['Resign', 'PHK', 'Pensiun']) : null;
            $tanggalKeluar = $alasanKeluar ? (clone $tanggalMasuk)->modify('+'.rand(1,3).' months') : null;

            DB::table('kepegawaian')->insert([
                'id_kepegawaian'     => Str::uuid(),
                'id_karyawan'        => $idKaryawan,
                'nik_karyawan'       => $faker->unique()->numerify('EMP#####'),
                'email_kantor'       => $faker->unique()->companyEmail(),
                'id_status_karyawan' => $faker->randomElement($statusIds),
                'id_section'         => $faker->randomElement($sectionIds),
                'id_jabatan'         => $faker->randomElement($jabatanIds),
                'atasan_langsung'    => $atasanLangsung,
                'alasan_keluar'      => $alasanKeluar,
                'tanggal_masuk'      => $tanggalMasuk->format('Y-m-d'),
                'tanggal_keluar'     => $tanggalKeluar?->format('Y-m-d'),
                'created_at'         => Carbon::now(),
                'updated_at'         => Carbon::now(),
                'deleted_at'         => null,
            ]);
        }
    }
}

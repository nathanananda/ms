<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RiwayatPendidikanOneEmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('riwayat_pendidikan')->insert([
            [
                'id_riwayat_pendidikan' => Str::uuid(),
                'id_karyawan' => 'a90a3739-3b0f-45e2-a6c9-448bcc1eaa9e',
                'tingkat_pendidikan' => 'S1',
                'institusi' => 'Universitas Gadjah Mada',
                'jurusan' => 'Ilmu Komputer',
                'gelar' => 'S.Kom.',
                'tahun_masuk' => 2015,
                'tahun_lulus' => 2019,
                'nilai' => 3.65,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => null,
            ],
            [
                'id_riwayat_pendidikan' => Str::uuid(),
                'id_karyawan' => 'a90a3739-3b0f-45e2-a6c9-448bcc1eaa9e',
                'tingkat_pendidikan' => 'S2',
                'institusi' => 'Institut Teknologi Bandung',
                'jurusan' => 'Sistem Informasi',
                'gelar' => 'M.Kom.',
                'tahun_masuk' => 2020,
                'tahun_lulus' => 2022,
                'nilai' => 3.80,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => null,
            ],
        ]);
    }
}

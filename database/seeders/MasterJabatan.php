<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MasterJabatan extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $jabatans = [
            ['jabatan' => 'Kepala Sekolah', 'level' => 1],
            ['jabatan' => 'Wakil Kepala Sekolah', 'level' => 2],
            ['jabatan' => 'Kepala Tata Usaha', 'level' => 2],
            ['jabatan' => 'Koordinator Kurikulum', 'level' => 3],
            ['jabatan' => 'Koordinator Kesiswaan', 'level' => 3],
            ['jabatan' => 'Koordinator Sarana dan Prasarana', 'level' => 3],
            ['jabatan' => 'Wali Kelas', 'level' => 4],
            ['jabatan' => 'Guru Mata Pelajaran', 'level' => 4],
            ['jabatan' => 'Guru BK (Bimbingan Konseling)', 'level' => 4],
            ['jabatan' => 'Staf TU (Administrasi)', 'level' => 5],
            ['jabatan' => 'Petugas Perpustakaan', 'level' => 5],
            ['jabatan' => 'Petugas Kebersihan', 'level' => 6],
            ['jabatan' => 'Satpam', 'level' => 6],
        ];

        foreach ($jabatans as $jabatan) {
            DB::table('master_jabatan')->insert([
                'id_jabatan' => Str::uuid(),
                'jabatan' => $jabatan['jabatan'],
                'created_at' => $now,
                'updated_at' => $now,
                'deleted_at' => null,
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class JenisTunjangan extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $tunjangans = [
            ['jenis_tunjangan' => 'Tunjangan Fungsional Guru', 'nominal' => 1500000],
            ['jenis_tunjangan' => 'Tunjangan Kepala Sekolah', 'nominal' => 2500000],
            ['jenis_tunjangan' => 'Tunjangan Wakil Kepala Sekolah', 'nominal' => 2000000],
            ['jenis_tunjangan' => 'Tunjangan Wali Kelas', 'nominal' => 500000],
            ['jenis_tunjangan' => 'Tunjangan BK/Konselor', 'nominal' => 750000],
            ['jenis_tunjangan' => 'Tunjangan Operator Sekolah', 'nominal' => 1000000],
            ['jenis_tunjangan' => 'Tunjangan TU/Staf Administrasi', 'nominal' => 800000],
            ['jenis_tunjangan' => 'Tunjangan Karyawan Perpustakaan', 'nominal' => 700000],
            ['jenis_tunjangan' => 'Tunjangan Karyawan Laboratorium', 'nominal' => 700000],
            ['jenis_tunjangan' => 'Tunjangan Transportasi', 'nominal' => 400000],
        ];

        foreach ($tunjangans as $item) {
            DB::table('jenis_tunjangan')->insert([
                'id_jenis_tunjangan' => Str::uuid(),
                'jenis_tunjangan' => $item['jenis_tunjangan'],
                'created_at' => $now,
                'updated_at' => $now,
                'deleted_at' => null,
            ]);
        }
    }
}

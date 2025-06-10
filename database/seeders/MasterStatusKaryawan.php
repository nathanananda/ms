<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MasterStatusKaryawan extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $statuses = [
            ['kode' => 'TETAP', 'status' => 'Pegawai Tetap'],
            ['kode' => 'KONTRK', 'status' => 'Pegawai Kontrak'],
            ['kode' => 'HONOR', 'status' => 'Tenaga Honorer'],
            ['kode' => 'PPPK',  'status' => 'Pegawai PPPK'],
            ['kode' => 'CPNS',  'status' => 'Calon Pegawai Negeri Sipil'],
            ['kode' => 'PNS',   'status' => 'Pegawai Negeri Sipil'],
            ['kode' => 'MAGANG', 'status' => 'Pegawai Magang'],
            ['kode' => 'PKL', 'status' => 'Praktik Kerja Lapangan (PKL)'],
            ['kode' => 'RELAWN', 'status' => 'Relawan'],
        ];

        foreach ($statuses as $item) {
            DB::table('master_status_karyawan')->insert([
                'id_status_karyawan' => Str::uuid(),
                'status_karyawan' => $item['status'],
                'created_at' => $now,
                'updated_at' => $now,
                'deleted_at' => null,
            ]);
        }
    }
}

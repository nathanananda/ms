<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MasterDivisi extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $divisions = [
            ['kode' => 'ADM', 'divisi' => 'Administrasi'],
            ['kode' => 'AKD', 'divisi' => 'Akademik'],
            ['kode' => 'KUR', 'divisi' => 'Kurikulum'],
            ['kode' => 'HRD', 'divisi' => 'Sumber Daya Manusia'],
            ['kode' => 'KEU', 'divisi' => 'Keuangan'],
            ['kode' => 'ICT', 'divisi' => 'Teknologi Informasi'],
            ['kode' => 'PRK', 'divisi' => 'Prasarana dan Sarana'],
            ['kode' => 'HUM', 'divisi' => 'Hubungan Masyarakat'],
            ['kode' => 'KSK', 'divisi' => 'Kesiswaan'],
            ['kode' => 'LBR', 'divisi' => 'Perpustakaan'],
        ];

        foreach ($divisions as $divisi) {
            DB::table('master_divisi')->insert([
                'id_divisi'  => Str::uuid(),
                'kode_divisi' => $divisi['kode'],
                'nama_divisi'      => $divisi['divisi'],
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
                'deleted_at'  => null,
            ]);
        }
    }
}

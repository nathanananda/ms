<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class KecSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cari id kota Bekasi
        $kotaBekasi = DB::table('master_kota')->where('nama_kota', 'Bekasi')->first();

        if (!$kotaBekasi) {
            $this->command->error('Kota Bekasi tidak ditemukan di tabel master_kota!');
            return;
        }

        $kecamatanBekasi = [
            'Bekasi Selatan',
            'Bekasi Timur',
            'Bekasi Utara',
            'Jatiasih',
            'Jatisampurna',
            'Medan Satria',
            'Mustika Jaya',
            'Pondok Gede',
            'Pondok Melati',
            'Rawa Lumbu',
            'Rawalumbu',
            'Bantargebang',
        ];

        foreach ($kecamatanBekasi as $kecamatan) {
            DB::table('master_kecamatan')->insert([
                'id_kecamatan' => Str::uuid(),
                'nama_kecamatan' => $kecamatan,
                'id_kota' => $kotaBekasi->id_kota,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->command->info('Seeder MasterKecamatan untuk Kota Bekasi selesai.');
    }
}

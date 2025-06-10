<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class KelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil semua kecamatan di Kota Bekasi
        $kecamatanBekasi = DB::table('master_kecamatan')
            ->join('master_kota', 'master_kecamatan.id_kota', '=', 'master_kota.id_kota')
            ->where('master_kota.nama_kota', 'Bekasi')
            ->select('master_kecamatan.id_kecamatan', 'master_kecamatan.nama_kecamatan')
            ->get();

        if ($kecamatanBekasi->isEmpty()) {
            $this->command->error('Data kecamatan untuk Kota Bekasi tidak ditemukan.');
            return;
        }

        // Data kelurahan per kecamatan
        $kelurahanData = [
            'Bekasi Selatan' => [
                ['nama' => 'Pekayon Jaya', 'kodepos' => 17148],
                ['nama' => 'Jaka Setia', 'kodepos' => 17147],
                ['nama' => 'Kayuringin Jaya', 'kodepos' => 17144],
            ],
            'Bekasi Timur' => [
                ['nama' => 'Mustika Jaya', 'kodepos' => 17158],
                ['nama' => 'Jatirasa', 'kodepos' => 17159],
                ['nama' => 'Jatisari', 'kodepos' => 17157],
            ],
            'Bekasi Utara' => [
                ['nama' => 'Harapan Jaya', 'kodepos' => 17121],
                ['nama' => 'Kaliabang Tengah', 'kodepos' => 17123],
                ['nama' => 'Pekayon', 'kodepos' => 17124],
            ],
            'Jatiasih' => [
                ['nama' => 'Jatiasih', 'kodepos' => 17421],
                ['nama' => 'Jatikramat', 'kodepos' => 17422],
                ['nama' => 'Jati Makmur', 'kodepos' => 17423],
            ],
            'Jatisampurna' => [
                ['nama' => 'Jatisampurna', 'kodepos' => 17432],
                ['nama' => 'Jaticempaka', 'kodepos' => 17431],
                ['nama' => 'Jatimulya', 'kodepos' => 17433],
            ],
            'Medan Satria' => [
                ['nama' => 'Medan Satria', 'kodepos' => 17131],
                ['nama' => 'Kayuringin Lama', 'kodepos' => 17132],
                ['nama' => 'Jatirahayu', 'kodepos' => 17133],
            ],
            'Mustika Jaya' => [
                ['nama' => 'Mustika Jaya', 'kodepos' => 17158],
                ['nama' => 'Sepanjang Jaya', 'kodepos' => 17159],
                ['nama' => 'Jatiwarna', 'kodepos' => 17157],
            ],
            'Pondok Gede' => [
                ['nama' => 'Pondok Gede', 'kodepos' => 17423],
                ['nama' => 'Jaka Mulya', 'kodepos' => 17424],
                ['nama' => 'Jaka Sampurna', 'kodepos' => 17425],
            ],
            'Pondok Melati' => [
                ['nama' => 'Pondok Melati', 'kodepos' => 17421],
                ['nama' => 'Duren Jaya', 'kodepos' => 17422],
                ['nama' => 'Kayuringin Jaya', 'kodepos' => 17423],
            ],
            'Rawa Lumbu' => [
                ['nama' => 'Rawa Lumbu', 'kodepos' => 17154],
                ['nama' => 'Jatiwaringin', 'kodepos' => 17155],
                ['nama' => 'Jatimekar', 'kodepos' => 17156],
            ],
            'Rawalumbu' => [
                ['nama' => 'Rawalumbu', 'kodepos' => 17157],
                ['nama' => 'Jatimulya', 'kodepos' => 17158],
                ['nama' => 'Jatibening', 'kodepos' => 17159],
            ],
            'Bantargebang' => [
                ['nama' => 'Bantargebang', 'kodepos' => 17161],
                ['nama' => 'Jatimulya', 'kodepos' => 17162],
                ['nama' => 'Jatiwarna', 'kodepos' => 17163],
            ],
        ];

        foreach ($kecamatanBekasi as $kecamatan) {
            $namaKecamatan = $kecamatan->nama_kecamatan;
            if (!isset($kelurahanData[$namaKecamatan])) {
                $this->command->warn("Data kelurahan untuk kecamatan $namaKecamatan tidak ditemukan, dilewati.");
                continue;
            }

            foreach ($kelurahanData[$namaKecamatan] as $kelurahan) {
                DB::table('master_kelurahan')->insert([
                    'id_kelurahan' => Str::uuid(),
                    'nama_kelurahan' => $kelurahan['nama'],
                    'id_kecamatan' => $kecamatan->id_kecamatan,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'deleted_at' => null,
                ]);
            }
        }

        $this->command->info('Seeder MasterKelurahan untuk Kota Bekasi selesai.');
    }
}

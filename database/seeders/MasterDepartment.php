<?php

namespace Database\Seeders;

use App\Models\MasterDivisi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MasterDepartment extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departemenPerDivisi = [
            'ADM' => ['Surat-Menyurat', 'Dokumentasi & Arsip'],
            'AKD' => ['Pengajaran', 'Jadwal & Absensi'],
            'KUR' => ['Evaluasi Kurikulum', 'Pengembangan Modul'],
            'HRD' => ['Rekrutmen Guru', 'Pelatihan & Pengembangan'],
            'KEU' => ['Pembayaran SPP', 'Anggaran Operasional'],
            'ICT' => ['Pemeliharaan Sistem', 'Pengembangan Aplikasi'],
            'PRK' => ['Fasilitas Umum', 'Laboratorium'],
            'HUM' => ['Media Sosial', 'Kemitraan'],
            'KSK' => ['Bimbingan Konseling', 'Ekstrakurikuler'],
            'LBR' => ['Koleksi Buku', 'Layanan Digital'],
        ];

        $now = Carbon::now();

        foreach ($departemenPerDivisi as $kodeDivisi => $departemens) {
            $divisi = MasterDivisi::where('kode_divisi', $kodeDivisi)->first();
            if (!$divisi) continue;

            foreach ($departemens as $index => $departemen) {
                DB::table('master_departemen')->insert([
                    'id_departemen'    => Str::uuid(),
                    'kode_departemen'  => strtoupper(substr($kodeDivisi, 0, 2)) . ($index + 1),
                    'nama_departemen'  => $departemen,
                    'id_divisi'        => $divisi->id_divisi,
                    'created_at'       => $now,
                    'updated_at'       => $now,
                    'deleted_at'       => null,
                ]);
            }
        }
    }
}

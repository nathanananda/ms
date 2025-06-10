<?php

namespace Database\Seeders;

use App\Models\MasterDepartemen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MasterSection extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        // Contoh daftar section berdasarkan departemen secara umum
        $sectionTemplates = [
            'Pengajaran'              => ['Rencana Pembelajaran', 'Evaluasi Harian', 'Laporan Kemajuan'],
            'Jadwal & Absensi'        => ['Manajemen Jadwal', 'Rekap Absensi', 'Koordinasi Guru'],
            'Rekrutmen Guru'          => ['Proses Interview', 'Verifikasi Dokumen', 'Database Guru'],
            'Pelatihan & Pengembangan' => ['Workshop Internal', 'Sertifikasi Guru', 'Program Mentoring'],
            'Pembayaran SPP'          => ['Penerimaan Kas', 'Reminder Pembayaran', 'Rekonsiliasi Bank'],
            'Anggaran Operasional'    => ['Penyusunan Budget', 'Realisasi Anggaran', 'Laporan Bulanan'],
            'Pemeliharaan Sistem'     => ['Monitoring Jaringan', 'Backup Data', 'Pengelolaan Server'],
            'Pengembangan Aplikasi'   => ['Aplikasi Siswa', 'Portal Guru', 'Mobile App'],
            'Fasilitas Umum'          => ['Kebersihan', 'Keamanan', 'Sarana Prasarana'],
            'Laboratorium'            => ['Laboratorium IPA', 'Lab Komputer', 'Lab Bahasa'],
            'Media Sosial'            => ['Konten Harian', 'Publikasi Event', 'Manajemen Komentar'],
            'Kemitraan'               => ['Kerja Sama Eksternal', 'Relasi Alumni', 'Corporate Social'],
            'Bimbingan Konseling'     => ['Sesi Konseling', 'Kasus Siswa', 'Psikotes'],
            'Ekstrakurikuler'         => ['Olahraga', 'Kesenian', 'Klub Akademik'],
            'Koleksi Buku'            => ['Peminjaman Buku', 'Katalogisasi', 'Pengadaan Buku'],
            'Layanan Digital'         => ['e-Library', 'Sistem Booking', 'E-Resource Management'],
            // default fallback jika nama tidak ada
            'default'                 => ['Section A', 'Section B', 'Section C'],
        ];

        $departemens = MasterDepartemen::all();

        foreach ($departemens as $departemen) {
            $nama = $departemen->nama_departemen;
            $sections = $sectionTemplates[$nama] ?? $sectionTemplates['default'];

            foreach ($sections as $index => $sectionName) {
                DB::table('master_section')->insert([
                    'id_section'     => Str::uuid(),
                    'kode_section'   => strtoupper(substr($nama, 0, 2)) . ($index + 1),
                    'nama_section'   => $sectionName,
                    'id_departemen'  => $departemen->id_departemen,
                    'created_at'     => $now,
                    'updated_at'     => $now,
                    'deleted_at'     => null,
                ]);
            }
        }
    }
}

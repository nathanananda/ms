<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class KotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        // Ambil data provinsi dari tabel master_provinsi
        $provinsi = DB::table('master_provinsi')->get()->keyBy('nama_provinsi');

        // Daftar kota dan provinsi sesuai data resmi
        $kotaProvinsi = [
            'Banda Aceh' => 'Aceh',
            'Langsa' => 'Aceh',
            'Lhokseumawe' => 'Aceh',
            'Sabang' => 'Aceh',
            'Subulussalam' => 'Aceh',
            'Medan' => 'Sumatera Utara',
            'Binjai' => 'Sumatera Utara',
            'Padang' => 'Sumatera Barat',
            'Pekanbaru' => 'Riau',
            'Jambi' => 'Jambi',
            'Palembang' => 'Sumatera Selatan',
            'Bengkulu' => 'Bengkulu',
            'Bandar Lampung' => 'Lampung',
            'Pangkalpinang' => 'Bangka Belitung',
            'Tanjung Pinang' => 'Kepulauan Riau',
            'Jakarta' => 'DKI Jakarta',
            'Bandung' => 'Jawa Barat',
            'Bekasi' => 'Jawa Barat',
            'Bogor' => 'Jawa Barat',
            'Cimahi' => 'Jawa Barat',
            'Cirebon' => 'Jawa Barat',
            'Depok' => 'Jawa Barat',
            'Sukabumi' => 'Jawa Barat',
            'Tasikmalaya' => 'Jawa Barat',
            'Serang' => 'Banten',
            'Tangerang' => 'Banten',
            'Tangerang Selatan' => 'Banten',
            'Cilegon' => 'Banten',
            'Semarang' => 'Jawa Tengah',
            'Surakarta' => 'Jawa Tengah',
            'Salatiga' => 'Jawa Tengah',
            'Magelang' => 'Jawa Tengah',
            'Tegal' => 'Jawa Tengah',
            'Pekalongan' => 'Jawa Tengah',
            'Yogyakarta' => 'DI Yogyakarta',
            'Surabaya' => 'Jawa Timur',
            'Malang' => 'Jawa Timur',
            'Kediri' => 'Jawa Timur',
            'Madiun' => 'Jawa Timur',
            'Pasuruan' => 'Jawa Timur',
            'Probolinggo' => 'Jawa Timur',
            'Denpasar' => 'Bali',
            'Mataram' => 'Nusa Tenggara Barat',
            'Kupang' => 'Nusa Tenggara Timur',
            'Pontianak' => 'Kalimantan Barat',
            'Singkawang' => 'Kalimantan Barat',
            'Palangka Raya' => 'Kalimantan Tengah',
            'Banjarmasin' => 'Kalimantan Selatan',
            'Banjarbaru' => 'Kalimantan Selatan',
            'Samarinda' => 'Kalimantan Timur',
            'Balikpapan' => 'Kalimantan Timur',
            'Bontang' => 'Kalimantan Timur',
            'Tarakan' => 'Kalimantan Utara',
            'Manado' => 'Sulawesi Utara',
            'Bitung' => 'Sulawesi Utara',
            'Tomohon' => 'Sulawesi Utara',
            'Kotamobagu' => 'Sulawesi Utara',
            'Palu' => 'Sulawesi Tengah',
            'Makassar' => 'Sulawesi Selatan',
            'Parepare' => 'Sulawesi Selatan',
            'Palopo' => 'Sulawesi Selatan',
            'Kendari' => 'Sulawesi Tenggara',
            'Baubau' => 'Sulawesi Tenggara',
            'Gorontalo' => 'Gorontalo',
            'Mamuju' => 'Sulawesi Barat',
            'Ambon' => 'Maluku',
            'Tual' => 'Maluku',
            'Ternate' => 'Maluku Utara',
            'Tidore Kepulauan' => 'Maluku Utara',
            'Jayapura' => 'Papua',
            'Sorong' => 'Papua Barat',
            'Nabire' => 'Papua Tengah',
            'Wamena' => 'Papua Pegunungan',
            'Merauke' => 'Papua Selatan',
            'Manokwari' => 'Papua Barat',
            'Fakfak' => 'Papua Barat',
            'Timika' => 'Papua',
            'Agats' => 'Papua Selatan',
            'Dekai' => 'Papua Pegunungan',
            'Oksibil' => 'Papua Pegunungan',
            'Enarotali' => 'Papua Tengah',
            'Elelim' => 'Papua Pegunungan',
            'Karubaga' => 'Papua Pegunungan',
            'Sugapa' => 'Papua Tengah',
            'Ilaga' => 'Papua Tengah',
            'Sinak' => 'Papua Tengah',
            'Mulia' => 'Papua Pegunungan',
            'Kenyam' => 'Papua Pegunungan',
        ];

        $data = [];

        foreach ($kotaProvinsi as $namaKota => $namaProvinsi) {
            $prov = $provinsi[$namaProvinsi] ?? null;
            if (!$prov) {
                continue;
            }

            $data[] = [
                'id_kota' => Str::uuid(),
                'nama_kota' => $namaKota,
                'id_provinsi' => $prov->id_provinsi,
                'created_at' => $now,
                'updated_at' => $now,
                'deleted_at' => null
            ];
        }

        DB::table('master_kota')->insert($data);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alamat;
use App\Models\Karyawan;
use App\Models\Kepegawaian;
use App\Models\KontakDarurat;
use App\Models\KontrakKaryawan;
use App\Models\MasterAgama;
use App\Models\MasterProvinsi;
use App\Models\Penggajian;
use App\Models\RiwayatPendidikan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminOnboardingController extends Controller
{
    public function onBoarding()
    {
        $dataOnboarding = Karyawan::select(
            'karyawan.id_karyawan',
            'karyawan.nama_lengkap',
            'k.email_kantor',
            'msk.status_karyawan',
            'mj.jabatan',
            'kon.awal_kontrak'
        )
            ->join('kepegawaian as k', 'k.id_karyawan', '=', 'karyawan.id_karyawan')
            ->join('master_status_karyawan as msk', 'k.id_status_karyawan', '=', 'msk.id_status_karyawan')
            ->join('master_jabatan as mj', 'k.id_jabatan', '=', 'mj.id_jabatan')
            ->join('kontrak_karyawan as kon', 'kon.id_karyawan', '=', 'k.id_karyawan')
            ->get();

        $today = Carbon::now();
        $minDate = $today->copy()->subDays(8)->startOfDay(); // 8 hari ke belakang
        $maxDate = $today->copy()->endOfDay();               // Sampai hari ini

        $dataFiltered = $dataOnboarding->filter(function ($item) use ($minDate, $maxDate) {
            $awalKontrak = Carbon::parse($item->awal_kontrak);
            return $awalKontrak->between($minDate, $maxDate);
        })->values();

        return view('admin.karyawan.onboarding', [
            'dataOnboarding' => $dataFiltered
        ]);
    }

    public function detailOnboarding($id)
    {
        $MasterAgama = MasterAgama::all();
        $dataPribadi = Karyawan::select(
            'karyawan.id_karyawan',
            'karyawan.nama_lengkap',
            'k.nik_karyawan',
            'karyawan.jenis_kelamin',
            'karyawan.no_hp',
            'karyawan.tempat_lahir',
            'karyawan.tanggal_lahir',
            'karyawan.id_agama',
            'agama.agama',
            'mj.jabatan',
            'msk.status_karyawan',
            'karyawan.status_aktif',
            'karyawan.no_ktp',
            'karyawan.email_pribadi',
            'karyawan.status_nikah',
            'karyawan.kewarganegaraan',
            'karyawan.golongan_darah',
            'karyawan.tinggi_badan',
            'karyawan.berat_badan',
        )->join('kepegawaian as k', 'k.id_karyawan', '=', 'karyawan.id_karyawan')
            ->join('master_agama as agama', 'agama.id_agama', '=', 'karyawan.id_agama')
            ->join('master_status_karyawan as msk', 'k.id_status_karyawan', '=', 'msk.id_status_karyawan')
            ->join('master_jabatan as mj', 'k.id_jabatan', '=', 'mj.id_jabatan')
            ->where('karyawan.id_karyawan', $id)->first();

        $dataProvinsi = MasterProvinsi::all();
        $dataAlamat = Alamat::select(
            'alamat.*',
            'kel.nama_kelurahan',
            'kec.nama_kecamatan',
            'kota.nama_kota',
            'prov.nama_provinsi'
        )->join('master_kelurahan as kel', 'kel.id_kelurahan', '=', 'alamat.id_kelurahan')
            ->join('master_kecamatan as kec', 'kec.id_kecamatan', '=', 'kel.id_kecamatan')
            ->join('master_kota as kota', 'kota.id_kota', '=', 'kec.id_kota')
            ->join('master_provinsi as prov', 'prov.id_provinsi', '=', 'kota.id_provinsi')
            ->where('alamat.id_karyawan', operator: $dataPribadi->id_karyawan)->first();

        $dataKontak = KontakDarurat::where('id_karyawan', operator: $dataPribadi->id_karyawan)->first();

        $dataPendidikan = RiwayatPendidikan::where('id_karyawan', operator: $dataPribadi->id_karyawan)->get();
        $dataKepegawaian = Kepegawaian::select(
            'kepegawaian.nik_karyawan',
            'kepegawaian.email_kantor',
            'msk.status_karyawan',
            'ms.nama_section',
            'md.nama_departemen',
            'div.nama_divisi',
            'mj.jabatan',
            'k.nama_lengkap',
            'kepegawaian.alasan_keluar',
        )->join('master_status_karyawan as msk', 'msk.id_status_karyawan', '=', 'kepegawaian.id_status_karyawan')
            ->join('master_jabatan as mj', 'mj.id_jabatan', '=', 'kepegawaian.id_jabatan')
            ->join('master_section as ms', 'ms.id_section', '=', 'kepegawaian.id_section')
            ->join('master_departemen as md', 'md.id_departemen', '=', 'ms.id_departemen')
            ->join('master_divisi as div', 'div.id_divisi', '=', 'md.id_divisi')
            ->join('karyawan as k', 'k.id_karyawan', '=', 'kepegawaian.atasan_langsung')
            ->where('kepegawaian.id_karyawan', operator: $id)->first();

        $dataPenggajian = Penggajian::where('id_karyawan', operator: $dataPribadi->id_karyawan)->first();
        $dataKontrak = KontrakKaryawan::where('id_karyawan', operator: $dataPribadi->id_karyawan)->where('status_kontrak', '1')->first();

        $dataPendidikan = RiwayatPendidikan::where('id_karyawan', operator: $dataPribadi->id_karyawan)->where('deleted_at', null)->orderBy('tahun_lulus', 'desc')->get();
        return view('admin.karyawan.detailOnboarding', [
            'MasterAgama' => $MasterAgama,
            'MasterProvinsi' => $dataProvinsi,
            'dataPribadi' => $dataPribadi,
            'dataAlamat' => $dataAlamat,
            'dataKontak' => $dataKontak,
            'dataPendidikan' => $dataPendidikan,
            'dataKepegawaian' => $dataKepegawaian,
            'dataPenggajian' => $dataPenggajian,
            'dataKontrak' => $dataKontrak,
        ]);
    }
}

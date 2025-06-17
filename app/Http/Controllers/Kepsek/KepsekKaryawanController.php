<?php

namespace App\Http\Controllers\Kepsek;

use App\Http\Controllers\Controller;
use App\Models\Alamat;
use App\Models\JenisTunjangan;
use App\Models\Karyawan;
use App\Models\Kepegawaian;
use App\Models\KontakDarurat;
use App\Models\KontrakKaryawan;
use App\Models\MasterAgama;
use App\Models\MasterJabatan;
use App\Models\MasterProvinsi;
use App\Models\MasterSection;
use App\Models\MasterStatusKaryawan;
use App\Models\Notif;
use App\Models\Penggajian;
use App\Models\RiwayatPendidikan;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class KepsekKaryawanController extends Controller
{
    public function list($status)
    {
        if ($status == 'all') {
            $listData = Karyawan::select(
                'karyawan.id_karyawan',
                'karyawan.nama_lengkap',
                'master_jabatan.jabatan',
                'master_status_karyawan.status_karyawan'
            )
                ->join('kepegawaian', 'kepegawaian.id_karyawan', '=', 'karyawan.id_karyawan')
                ->join('master_jabatan', 'master_jabatan.id_jabatan', '=', 'kepegawaian.id_jabatan')
                ->join('master_status_karyawan', 'master_status_karyawan.id_status_karyawan', '=', 'kepegawaian.id_status_karyawan')
                ->where('karyawan.status_aktif', True)
                ->where('karyawan.approval_kepsek', 2)->paginate(12);
        } else {
            $listData = Karyawan::select(
                'karyawan.id_karyawan',
                'karyawan.nama_lengkap',
                'master_jabatan.jabatan',
                'master_status_karyawan.status_karyawan'
            )
                ->join('kepegawaian', 'kepegawaian.id_karyawan', '=', 'karyawan.id_karyawan')
                ->join('master_jabatan', 'master_jabatan.id_jabatan', '=', 'kepegawaian.id_jabatan')
                ->join('master_status_karyawan', 'master_status_karyawan.id_status_karyawan', '=', 'kepegawaian.id_status_karyawan')
                ->where('karyawan.status_aktif', True)
                ->where('karyawan.approval_kepsek', 2)
                ->where('master_status_karyawan.status_karyawan', $status)->paginate(12);
        }


        $StatusAll = MasterStatusKaryawan::all();
        $listWarna = [];

        foreach ($StatusAll as $a) {
            $nama = $a->status_karyawan;

            switch (true) {
                case str_contains($nama, 'Pegawai Tetap'):
                    $listWarna[$a->status_karyawan] = 'bg-[#137D28]';
                    break;
                case str_contains($nama, 'Pegawai Kontrak'):
                    $listWarna[$a->status_karyawan] = 'bg-[#F8901F]';
                    break;
                case str_contains($nama, 'Tenaga Honorer'):
                    $listWarna[$a->status_karyawan] = 'bg-[#1FB7F8]';
                    break;
                case str_contains($nama, 'Pegawai PPPK'):
                    $listWarna[$a->status_karyawan] = 'bg-[#00668C]';
                    // dd($nama);
                    break;
                case str_contains($nama, 'PNS'):
                    $listWarna[$a->status_karyawan] = 'bg-[#D3A409]';
                    break;
                case str_contains($nama, 'Magang'):
                    $listWarna[$a->status_karyawan] = 'bg-[#F8901F]';
                    break;
                default:
                    $listWarna[$a->status_karyawan] = 'bg-[#565656]';
                    break;
            }
        }


        $dataStatus = Karyawan::join('kepegawaian', 'kepegawaian.id_karyawan', '=', 'karyawan.id_karyawan')
            ->join('master_status_karyawan', 'master_status_karyawan.id_status_karyawan', '=', 'kepegawaian.id_status_karyawan')
            ->where('karyawan.status_aktif', true)
            ->select('master_status_karyawan.status_karyawan', DB::raw('count(*) as total'))
            ->groupBy('master_status_karyawan.status_karyawan')
            ->get();
        $totalAll = $dataStatus->sum('total');


        return view('kepsek.karyawan.list', [
            'StatusAll' => $dataStatus,
            'listData' => $listData,
            'totalAll' => $totalAll,
            'masterStatus' => $StatusAll,
            'listWarna' => $listWarna
        ]);
    }

    public function detailKaryawan($id)
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

        return view('kepsek.karyawan.detail-karyawan', [
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

    public function updateKaryawan($id)
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
            'msk.id_status_karyawan',
            'ms.nama_section',
            'ms.id_section',
            'mj.id_jabatan',
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
        $dataKaryawan = Karyawan::select(
            'karyawan.id_karyawan',
            'karyawan.nama_lengkap',
            'k.nik_karyawan',
            'karyawan.no_hp',
            'karyawan.tempat_lahir',
            'karyawan.tanggal_lahir',
            'msk.status_karyawan',
            'mj.jabatan',
            'al.alamat',
            'mk.id_kelurahan',
            'mk.nama_kelurahan',
            'kec.id_kecamatan',
            'kec.nama_kecamatan',
            'kota.id_kota',
            'kota.nama_kota',
            'prov.nama_provinsi',
            'prov.id_provinsi'
        )->join('kepegawaian as k', 'k.id_karyawan', '=', 'karyawan.id_karyawan')
            ->join('master_status_karyawan as msk', 'k.id_status_karyawan', '=', 'msk.id_status_karyawan')
            ->join('master_jabatan as mj', 'k.id_jabatan', '=', 'mj.id_jabatan')
            ->join('alamat as al', 'al.id_karyawan', '=', 'k.id_karyawan')
            ->join('master_kelurahan as mk', 'mk.id_kelurahan', '=', 'al.id_kelurahan')
            ->join('master_kecamatan as kec', 'kec.id_kecamatan', '=', 'mk.id_kecamatan')
            ->join('master_kota as kota', 'kota.id_kota', '=', 'kec.id_kota')
            ->join('master_provinsi as prov', 'prov.id_provinsi', '=', 'kota.id_provinsi')
            ->where('karyawan.id_karyawan', $id)->first();

        $dataPendidikan = RiwayatPendidikan::where('id_karyawan', $id)->where('deleted_at', null)->get();
        $MasterSection = MasterSection::where('deleted_at', null)->get();
        $MasterStatus = MasterStatusKaryawan::where('deleted_at', null)->get();
        $MasterJabatan = MasterJabatan::where('deleted_at', null)->get();

        return view('kepsek.karyawan.update-karyawan', [
            'dataKaryawan' => $dataKaryawan,
            'MasterAgama' => $MasterAgama,
            'MasterProvinsi' => $dataProvinsi,
            'dataPribadi' => $dataPribadi,
            'dataAlamat' => $dataAlamat,
            'dataKontak' => $dataKontak,
            'dataPendidikan' => $dataPendidikan,
            'dataKepegawaian' => $dataKepegawaian,
            'dataPenggajian' => $dataPenggajian,
            'dataKontrak' => $dataKontrak,
            'masterStatus' => $MasterStatus,
            'masterSection' => $MasterSection,
            'masterJabatan' => $MasterJabatan
        ]);
    }

    public function addPendidikan(Request $request)
    {
        try {
            $data = $request->except('_token');
            $data['id_riwayat_pendidikan'] = Str::uuid();
            RiwayatPendidikan::create($data);
            return redirect()->route('kepsek.karyawan.update-karyawan', ['id' => $request->id_karyawan])->with('toast_success', 'Pendidikan berhasil ditambahkan !');
        } catch (\Throwable $th) {
            return redirect()->route('kepsek.karyawan.update-karyawan', ['id' => $request->id_karyawan])->with('toast_error', 'Pendidikan gagal ditambahkan !');
        }
    }

    public function updatePendidikan(Request $request)
    {
        try {
            $data = $request->except('_token');
            RiwayatPendidikan::where('id_riwayat_pendidikan', $request->id_riwayat_pendidikan)->update($data);
            return redirect()->route('kepsek.karyawan.update-karyawan', ['id' => $request->id_karyawan])->with('toast_success', 'Pendidikan berhasil diubah !');
        } catch (\Throwable $th) {
            return redirect()->route('kepsek.karyawan.update-karyawan', ['id' => $request->id_karyawan])->with('toast_error', 'Pendidikan gagal diubah !');
        }
    }

    public function deletePendidikan($id)
    {
        try {
            $data = RiwayatPendidikan::where('id_riwayat_pendidikan', $id)->first();
            $data->deleted_at = Carbon::now();
            $data->save();
            return redirect()->route('kepsek.karyawan.update-karyawan', ['id' => $data->id_karyawan])->with('toast_success', 'Pendidikan berhasil dihapus !');
        } catch (\Throwable $th) {
            return redirect()->route('kepsek.karyawan.update-karyawan', ['id' => $data->id_karyawan])->with('toast_error', 'Pendidikan gagal dihapus !');
        }
    }

    public function updatePenggajian(Request $request)
    {
        try {

            $data = $request->except('_token');
            $dataPenggajian = Penggajian::where('id_karyawan', $request->id_karyawan)->first();
            $dataPenggajian->update($data);
            return redirect()->route('kepsek.karyawan.update-karyawan', ['id' => $request->id_karyawan])->with('toast_success', 'Penggajian berhasil diubah !');
        } catch (Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function updateKepegawaian(Request $request)
    {
        try {
            $data = $request->except('_token');
            $dataKepegawaian = Kepegawaian::where('id_karyawan', $request->id_karyawan)->first();
            $dataKepegawaian->update($data);
            return redirect()->route('kepsek.karyawan.update-karyawan', ['id' => $request->id_karyawan])->with('toast_success', 'Kepegawaian berhasil diubah !');
        } catch (Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function updateKontakDarurat(Request $request)
    {
        try {
            $data = $request->except('_token');
            $dataKontakDarurat = KontakDarurat::where('id_karyawan', $request->id_karyawan)->first();
            $dataKontakDarurat->update($data);
            return redirect()->route('kepsek.karyawan.update-karyawan', ['id' => $request->id_karyawan])->with('toast_success', 'Kontak Darurat berhasil diubah !');
        } catch (Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function updateProfile(Request $request)
    {
        try {
            $data = $request->except('_token');
            $dataProfile = Karyawan::where('id_karyawan', $request->id_karyawan)->first();
            $dataProfile->update($data);
            return redirect()->route('kepsek.karyawan.update-karyawan', ['id' => $request->id_karyawan])->with('toast_success', 'Profile berhasil diubah !');
        } catch (Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }


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
        })->values(); // <== Reset index ke 0


        return view('kepsek.karyawan.onboarding', [
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
        return view('kepsek.karyawan.detailOnboarding', [
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

    public function addKaryawan()
    {
        $dataStatus = MasterStatusKaryawan::all();
        $dataJabatan = MasterJabatan::all();
        $dataTunjangan = JenisTunjangan::where('deleted_at', null)->get();
        $dataAgama = MasterAgama::all();

        $listKaryawan = Karyawan::select(
            'karyawan.id_karyawan',
            'karyawan.nama_lengkap',
            'k.nik_karyawan'
        )->join('kepegawaian as k', 'k.id_karyawan', '=', 'karyawan.id_karyawan')->where('status_aktif', True)->get();

        return view('kepsek.karyawan.addKaryawan', [
            'dataStatus' => $dataStatus,
            'dataJabatan' => $dataJabatan,
            'dataTunjangan' => $dataTunjangan,
            'listKaryawan' => $listKaryawan,
            'dataAgama' => $dataAgama
        ]);
    }

    public function StoreKaryawan(Request $request)
    {

        $validated = $request->validate([
            // Tahap 1 - Data Pribadi
            'nama_lengkap' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'id_agama' => 'required',
            'status_nikah' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
            'provinsi' => 'required',
            'kota' => 'required',
            'kecamatan' => 'required',
            'id_kelurahan' => 'required',
            'kodepos' => 'required',

            // Tahap 2 - Pendidikan
            'tingkat_pendidikan' => 'required',
            'institusi' => 'required',
            'jurusan' => 'required',
            'tahun_masuk' => 'required',
            'tahun_lulus' => 'required',
            'gelar' => 'required',
            'nilai' => 'required',

            // Kontak Darurat
            'nama_kontak_darurat' => 'required',
            'nomor_kontak_darurat' => 'required',
            'hubungan_kontak_darurat' => 'required',

            // Data Kepegawaian
            'nik_karyawan' => 'required',
            'email_kantor' => 'required|email',
            'id_status_karyawan' => 'required',
            'divisi' => 'required',
            'departemen' => 'required',
            'id_section' => 'required',
            'id_jabatan' => 'required',
            'atasan_langsung' => 'required',
            'alasan_keluar' => 'nullable',

            // Tahap 3 - Penggajian
            'kode_golongan' => 'required',
            'id_jenis_tunjangan' => 'required',
            'npwp' => 'required',
            'no_rekening' => 'required',
            'no_bpjs_kesehatan' => 'required',
            'no_bpjs_ketenagakerjaan' => 'required',
            'no_bpjs_pensiun' => 'required',

            // Kontrak
            'awal_kontrak' => 'required|date',
            'akhir_kontrak' => 'required|date|after_or_equal:awal_kontrak',
            'file_kontrak' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        DB::beginTransaction();

        try {
            // Insert Karyawan
            $dataKaryawan = $request->only([
                'nama_lengkap',
                'jenis_kelamin',
                'status_aktif',
                'no_ktp',
                'no_hp',
                'email_pribadi',
                'id_agama',
                'status_nikah',
                'tempat_lahir',
                'tanggal_lahir',
                'golongan_darah',
                'tinggi_badan',
                'berat_badan',
                'kewarganegaraan'
            ]);

            $idKaryawan = $dataKaryawan['id_karyawan'] = Str::uuid();
            if ($request->hasFile('foto')) {
                // Ambil file
                $file = $request->file('foto');
                // Generate nama acak dengan ekstensi asli
                $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
                // Simpan ke folder storage/app/profile
                $path = $file->storeAs('profile', $filename);
                $dataKaryawan['foto'] = $filename;
            }
            $dataKaryawan['approval_karyawan'] = 2;
            Karyawan::create($dataKaryawan);

            // Insert Alamat
            $dataAlamat = $request->only([
                'alamat',
                'jenis_alamat',
                'id_kelurahan',
                'kodepos'
            ]);
            $dataAlamat['id_karyawan'] = $idKaryawan;
            $dataAlamat['id_alamat'] = Str::uuid();
            Alamat::create($dataAlamat);

            // Insert Pendidikan Karyawan
            $dataPendidikan = $request->only([
                'tingkat_pendidikan',
                'institusi',
                'jurusan',
                'tahun_masuk',
                'tahun_lulus',
                'nilai',
                'gelar',
            ]);
            $dataPendidikan['id_karyawan'] = $idKaryawan;
            $dataPendidikan['id_riwayat_pendidikan'] = Str::uuid();
            RiwayatPendidikan::create($dataPendidikan);

            $dataKontakDarurat = $request->only([
                'nomor_kontak_darurat',
                'nama_kontak_darurat',
                'hubungan_kontak_darurat'
            ]);
            $dataKontakDarurat['id_karyawan'] = $idKaryawan;
            $dataKontakDarurat['id_kontak_darurat'] = Str::uuid();
            KontakDarurat::create($dataKontakDarurat);

            $dataKepegawaian = $request->only([
                'nik_karyawan',
                'email_kantor',
                'id_status_karyawan',
                'atasan_langsung',
                'id_section',
                'id_jabatan',
            ]);
            $dataKepegawaian['id_karyawan'] = $idKaryawan;
            $dataKepegawaian['id_kepegawaian'] = Str::uuid();
            $dataKepegawaian['tanggal_masuk'] = $request->awal_kontrak;
            Kepegawaian::create($dataKepegawaian);

            $dataPenggajian = $request->only([
                'kode_golongan',
                'npwp',
                'no_rekening',
                'no_bpjs_kesehatan',
                'no_bpjs_ketenagakerjaan',
                'no_bpjs_pensiun',
            ]);

            $dataPenggajian['id_karyawan'] = $idKaryawan;
            $dataPenggajian['id_penggajian'] = Str::uuid();
            Penggajian::create($dataPenggajian);

            $dataKontrak = $request->only(['awal_kontrak', 'akhir_kontrak']);
            $dataKontrak['id_karyawan'] = $idKaryawan;
            $dataKontrak['uuid'] = Str::uuid();
            $dataKontrak['status_kontrak'] = 1;
            if ($request->hasFile('file_kontrak')) {
                // Ambil file
                $file = $request->file('file_kontrak');
                // Generate nama acak dengan ekstensi asli
                $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
                // Simpan ke folder storage/app/profile
                $path = $file->storeAs('file_kontrak', $filename);
                $dataKontrak['file_kontrak'] = $filename;
            }
            KontrakKaryawan::create($dataKontrak);


            DB::commit();

            return redirect()->route('kepsek.karyawan.list', ['status' => 'all'])->with('toast_success', 'Data Berhasil Ditambahkan');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('toast_error', $e->getMessage());
        }
    }

    public function ExportExcel(Request $request)
    {
        $fields = (array) $request->input('field', []);
        $statusList = (array) $request->input('banyak-data', []);

        if (in_array('all-data', $statusList)) {
            $statusList = []; // abaikan filter
        }
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header awal
        $headers = ['ID', 'Nama Lengkap'];

        // Daftar header dinamis
        $fieldHeaders = [
            'kepegawaian' => [
                'NIK Karyawan',
                'Email Kantor',
                'Status Karyawan',
                'Section',
                'Departemen',
                'Divisi',
                'Jabatan'
            ],
            'penggajian' => [
                'Kode Golongan',
                'NPWP',
                'No Rekening',
                'No BPJS Kesehatan',
                'No BPJS Ketenagakerjaan',
                'No BPJS Pensiun'
            ],
            'kontrak' => [
                'Awal Kontrak',
                'Tanggal Kontrak'
            ],
            'pendidikan' => [
                'Tingkat Pendidikan',
                'Institusi',
                'Jurusan',
                'Gelar',
                'Tahun Masuk',
                'Tahun Lulus',
                'Nilai'
            ],
            'kontak-darurat' => [
                'Nama Kontak Darurat',
                'Hubungan',
                'No Kontak Darurat'
            ],
            'alamat' => [
                'Alamat',
                'Provinsi',
                'Kota',
                'Kecamatan',
                'Kelurahan',
                'Kode Pos'
            ],
            'data-pribadi' => [
                'Jenis Kelamin',
                'No KTP',
                'No HP',
                'Email Pribadi',
                'Agama',
                'Status Nikah',
                'Tempat Lahir',
                'Tanggal Lahir'
            ]
        ];

        foreach ($fields as $field) {
            if (isset($fieldHeaders[$field])) {
                $headers = array_merge($headers, $fieldHeaders[$field]);
            }
        }

        $sheet->fromArray($headers, null, 'A1');

        // Query dasar
        $query = Karyawan::query()
            ->where('karyawan.status_aktif', 1)
            ->select('karyawan.id_karyawan', 'karyawan.nama_lengkap');

        // Flags agar join tidak berulang
        $joined = [];

        // Join dan select dinamis
        foreach ($fields as $field) {
            switch ($field) {
                case 'kepegawaian':
                    if (!isset($joined['kepegawaian'])) {
                        $query->addSelect(
                            'peg.nik_karyawan',
                            'peg.email_kantor',
                            'msk.status_karyawan',
                            'ms.nama_section',
                            'md.nama_departemen',
                            'mdv.nama_divisi',
                            'mj.jabatan'
                        )
                            ->join('kepegawaian as peg', 'peg.id_karyawan', '=', 'karyawan.id_karyawan')
                            ->join('master_section as ms', 'ms.id_section', '=', 'peg.id_section')
                            ->join('master_departemen as md', 'md.id_departemen', '=', 'ms.id_departemen')
                            ->join('master_divisi as mdv', 'mdv.id_divisi', '=', 'md.id_divisi')
                            ->join('master_jabatan as mj', 'mj.id_jabatan', '=', 'peg.id_jabatan')
                            ->join('master_status_karyawan as msk', 'msk.id_status_karyawan', '=', 'peg.id_status_karyawan');
                        $joined['kepegawaian'] = true;
                    }
                    break;

                case 'penggajian':
                    if (!isset($joined['penggajian'])) {
                        $query->addSelect(
                            'gaji.kode_golongan',
                            'gaji.npwp',
                            'gaji.no_rekening',
                            'gaji.no_bpjs_kesehatan',
                            'gaji.no_bpjs_ketenagakerjaan',
                            'gaji.no_bpjs_pensiun'
                        )
                            ->leftJoin('penggajian as gaji', 'gaji.id_karyawan', '=', 'karyawan.id_karyawan');
                        $joined['penggajian'] = true;
                    }
                    break;

                case 'kontrak':
                    if (!isset($joined['kontrak'])) {
                        $query->addSelect('kontrak.awal_kontrak', 'kontrak.akhir_kontrak')
                            ->leftJoin('kontrak_karyawan as kontrak', 'kontrak.id_karyawan', '=', 'karyawan.id_karyawan');
                        $joined['kontrak'] = true;
                    }
                    break;

                case 'pendidikan':
                    if (!isset($joined['pendidikan'])) {
                        $query->addSelect(
                            'pen.tingkat_pendidikan',
                            'pen.institusi',
                            'pen.jurusan',
                            'pen.gelar',
                            'pen.tahun_masuk',
                            'pen.tahun_lulus',
                            'pen.nilai'
                        )
                            ->leftJoin('riwayat_pendidikan as pen', 'pen.id_karyawan', '=', 'karyawan.id_karyawan');
                        $joined['pendidikan'] = true;
                    }
                    break;

                case 'kontak-darurat':
                    if (!isset($joined['kontak-darurat'])) {
                        $query->addSelect('kd.nama_kontak', 'kd.hubungan', 'kd.no_kontak')
                            ->leftJoin('kontak_darurat as kd', 'kd.id_karyawan', '=', 'karyawan.id_karyawan');
                        $joined['kontak-darurat'] = true;
                    }
                    break;

                case 'alamat':
                    if (!isset($joined['alamat'])) {
                        $query->addSelect(
                            'al.alamat',
                            'mp.nama_provinsi',
                            'mkota.nama_kota',
                            'mc.nama_kecamatan',
                            'mk.nama_kelurahan',
                            'al.kode_pos'
                        )
                            ->leftJoin('alamat as al', 'al.id_karyawan', '=', 'karyawan.id_karyawan')
                            ->leftJoin('master_kelurahan as mk', 'mk.id_kelurahan', '=', 'al.id_kelurahan')
                            ->leftJoin('master_kecamatan as mc', 'mc.id_kecamatan', '=', 'mk.id_kecamatan')
                            ->leftJoin('master_kota as mkota', 'mkota.id_kota', '=', 'mc.id_kota')
                            ->leftJoin('master_provinsi as mp', 'mp.id_provinsi', '=', 'mkota.id_provinsi');
                        $joined['alamat'] = true;
                    }
                    break;

                case 'data-pribadi':
                    if (!isset($joined['data-pribadi'])) {
                        $query->addSelect(
                            'karyawan.jenis_kelamin',
                            'karyawan.no_ktp',
                            'karyawan.no_hp',
                            'karyawan.email_pribadi',
                            'agama.agama',
                            'karyawan.status_nikah',
                            'karyawan.tempat_lahir',
                            'karyawan.tanggal_lahir'
                        )->join('master_agama as agama', 'agama.id_agama', '=', 'karyawan.id_agama');
                        $joined['data-pribadi'] = true;
                    }
                    break;
            }
        }

        // Join peg jika ada filter status
        if (!empty($statusList) && !isset($joined['kepegawaian'])) {
            $query->join('kepegawaian as peg', 'peg.id_karyawan', '=', 'karyawan.id_karyawan');
            $joined['kepegawaian'] = true;
        }

        // Filter status karyawan jika diperlukan
        if (!empty($statusList)) {
            $query->whereIn('peg.id_status_karyawan', $statusList);
        }

        $dataKaryawan = $query->get();
        $row = 2;

        foreach ($dataKaryawan as $data) {
            $rowData = [$data->id_karyawan, $data->nama_lengkap];

            foreach ($fields as $field) {
                switch ($field) {
                    case 'kepegawaian':
                        $rowData[] = $data->nik_karyawan ?? '';
                        $rowData[] = $data->email_kantor ?? '';
                        $rowData[] = $data->status_karyawan ?? '';
                        $rowData[] = $data->nama_section ?? '';
                        $rowData[] = $data->nama_departemen ?? '';
                        $rowData[] = $data->nama_divisi ?? '';
                        $rowData[] = $data->jabatan ?? '';
                        break;

                    case 'penggajian':
                        $rowData[] = $data->kode_golongan ?? '';
                        $rowData[] = $data->npwp ?? '';
                        $rowData[] = $data->no_rekening ?? '';
                        $rowData[] = $data->no_bpjs_kesehatan ?? '';
                        $rowData[] = $data->no_bpjs_ketenagakerjaan ?? '';
                        $rowData[] = $data->no_bpjs_pensiun ?? '';
                        break;

                    case 'kontrak':
                        $rowData[] = $data->awal_kontrak ?? '';
                        $rowData[] = $data->akhir_kontrak ?? '';
                        break;

                    case 'pendidikan':
                        $rowData[] = $data->tingkat_pendidikan ?? '';
                        $rowData[] = $data->institusi ?? '';
                        $rowData[] = $data->jurusan ?? '';
                        $rowData[] = $data->gelar ?? '';
                        $rowData[] = $data->tahun_masuk ?? '';
                        $rowData[] = $data->tahun_lulus ?? '';
                        $rowData[] = $data->nilai ?? '';
                        break;

                    case 'kontak-darurat':
                        $rowData[] = $data->nama_kontak ?? '';
                        $rowData[] = $data->hubungan ?? '';
                        $rowData[] = $data->no_kontak ?? '';
                        break;

                    case 'alamat':
                        $rowData[] = $data->alamat ?? '';
                        $rowData[] = $data->nama_provinsi ?? '';
                        $rowData[] = $data->nama_kota ?? '';
                        $rowData[] = $data->nama_kecamatan ?? '';
                        $rowData[] = $data->nama_kelurahan ?? '';
                        $rowData[] = $data->kode_pos ?? '';
                        break;

                    case 'data-pribadi':
                        $rowData[] = $data->jenis_kelamin ?? '';
                        $rowData[] = $data->no_ktp ?? '';
                        $rowData[] = $data->no_hp ?? '';
                        $rowData[] = $data->email_pribadi ?? '';
                        $rowData[] = $data->agama ?? '';
                        $rowData[] = $data->status_nikah ?? '';
                        $rowData[] = $data->tempat_lahir ?? '';
                        $rowData[] = $data->tanggal_lahir ?? '';
                        break;
                }
            }

            $sheet->fromArray($rowData, null, 'A' . $row);
            $row++;
        }



        $writer = new Xlsx($spreadsheet);
        $filename = $request->input('nama_dokumen', 'data_karyawan') . '.xlsx';

        // Output file download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"$filename\"");
        $writer->save('php://output');
        exit;
    }
}

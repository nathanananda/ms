<?php

namespace App\Http\Controllers\Kepsek;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use App\Models\MasterJabatan;
use App\Models\MasterStatusKaryawan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class KepsekOffboardingController extends Controller
{

    public function index(Request $request)
    {
        $data = Karyawan::select(
            'karyawan.nama_lengkap',
            'karyawan.id_karyawan',
            'jab.jabatan',
            'msk.status_karyawan',
            'kon.akhir_kontrak',
        )
            ->join('kepegawaian as peg', 'peg.id_karyawan', '=', 'karyawan.id_karyawan')
            ->join('master_jabatan as jab', 'jab.id_jabatan', '=', 'peg.id_jabatan')
            ->join('master_status_karyawan as msk', 'msk.id_status_karyawan', '=', 'peg.id_status_karyawan')
            ->join('kontrak_karyawan as kon', 'kon.id_karyawan', '=', 'peg.id_karyawan')
            ->whereBetween('kon.akhir_kontrak', [
                Carbon::now()->startOfDay(),
                Carbon::now()->addDays(7)->endOfDay()
            ])
            ->where('kon.status_kontrak', 1)
            ->orderBy('kon.akhir_kontrak', 'asc')
            ->paginate(10);

        foreach ($data as $d) {
            $akhirKontrak = Carbon::parse($d->akhir_kontrak)->endOfDay(); // anggap aktif sampai jam 23:59
            $d->sisa_kontrak = Carbon::now()->diffInDays($akhirKontrak);
            $d->akhir_kontrak = $akhirKontrak->format('d F Y');
        }

        return view('kepsek.karyawan.offboarding.index', [
            'data' => $data
        ]);
    }

    public function Perpanjang(Request $request)
    {
        if (empty($request->id_karyawan)) {
            return redirect()->back()->with('toast_error', 'Invalid Data !');
        }
        $dataKaryawan = Karyawan::select(
            'karyawan.id_karyawan',
            'karyawan.nama_lengkap',
            'k.nik_karyawan',
            'msk.status_karyawan',
            'mj.jabatan'
        )->join('kepegawaian as k', 'k.id_karyawan', '=', 'karyawan.id_karyawan')
            ->join('master_status_karyawan as msk', 'k.id_status_karyawan', '=', 'msk.id_status_karyawan')
            ->join('master_jabatan as mj', 'k.id_jabatan', '=', 'mj.id_jabatan')
            ->where('karyawan.id_karyawan', $request->id_karyawan)->first();

        return view('kepsek.karyawan.offboarding.perpanjang', [
            'dataKaryawan' => $dataKaryawan
        ]);
    }

    public function Pengangkatan(Request $request)
    {
        if (empty($request->id_karyawan)) {
            return redirect()->back()->with('toast_error', 'Invalid Data !');
        }
        $dataKaryawan = Karyawan::select(
            'karyawan.id_karyawan',
            'karyawan.nama_lengkap',
            'k.nik_karyawan',
            'msk.id_status_karyawan',
            'mj.id_jabatan'
        )->join('kepegawaian as k', 'k.id_karyawan', '=', 'karyawan.id_karyawan')
            ->join('master_status_karyawan as msk', 'k.id_status_karyawan', '=', 'msk.id_status_karyawan')
            ->join('master_jabatan as mj', 'k.id_jabatan', '=', 'mj.id_jabatan')
            ->where('karyawan.id_karyawan', $request->id_karyawan)->first();

        $dataJabatan = MasterJabatan::all();
        $dataStatus = MasterStatusKaryawan::all();

        return view('kepsek.karyawan.offboarding.pengangkatan', [
            'dataKaryawan' => $dataKaryawan,
            'dataJabatan' => $dataJabatan,
            'dataStatus' => $dataStatus
        ]);
    }

    public function Layoff(Request $request)
    {
        if (empty($request->id_karyawan)) {
            return redirect()->back()->with('toast_error', 'Invalid Data !');
        }
        $dataKaryawan = Karyawan::select(
            'kon.uuid as id_kontrak',
            'karyawan.id_karyawan',
            'karyawan.nama_lengkap',
            'k.nik_karyawan',
            'msk.id_status_karyawan',
            'mj.id_jabatan',
            'kon.awal_kontrak',
            'kon.akhir_kontrak'
        )->join('kepegawaian as k', 'k.id_karyawan', '=', 'karyawan.id_karyawan')
            ->join('master_status_karyawan as msk', 'k.id_status_karyawan', '=', 'msk.id_status_karyawan')
            ->join('master_jabatan as mj', 'k.id_jabatan', '=', 'mj.id_jabatan')
            ->join('kontrak_karyawan as kon', 'kon.id_karyawan', '=', 'k.id_karyawan')
            ->where('karyawan.id_karyawan', $request->id_karyawan)->first();

        $dataJabatan = MasterJabatan::all();
        $dataStatus = MasterStatusKaryawan::all();

        return view('kepsek.karyawan.offboarding.layoff', [
            'dataKaryawan' => $dataKaryawan,
            'dataJabatan' => $dataJabatan,
            'dataStatus' => $dataStatus
        ]);
    }
}

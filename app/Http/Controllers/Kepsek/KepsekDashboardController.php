<?php

namespace App\Http\Controllers\Kepsek;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use App\Models\MasterStatusKaryawan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class KepsekDashboardController extends Controller
{
    public function index()
    {
        $countKaryawan = Karyawan::count();
        $MasterStatus = MasterStatusKaryawan::all();
        $countStatus = [];

        foreach ($MasterStatus as $status) {
            $countStatus[$status->status_karyawan] = Karyawan::join('kepegawaian as k', 'karyawan.id_karyawan', '=', 'k.id_karyawan')
                ->where('k.id_status_karyawan', $status->id_status_karyawan)
                ->count();
        }

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
        })->values()->take(5); // <== Reset index ke 0


        $dataOffboarding = Karyawan::select(
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
            ->limit(5)->get();

        foreach ($dataOffboarding as $d) {
            $akhirKontrak = Carbon::parse($d->akhir_kontrak)->endOfDay(); // anggap aktif sampai jam 23:59
            $d->sisa_kontrak = Carbon::now()->diffInDays($akhirKontrak);
            $d->akhir_kontrak = $akhirKontrak->format('d F Y');
        }

        return view('kepsek.dashboard', [
            'countKaryawan' => $countKaryawan,
            'countStatus' => $countStatus,
            'dataOnboarding' => $dataFiltered,
            'dataOffboarding' => $dataOffboarding
        ]);
    }

    public function getGender()
    {
        // Query menghitung total karyawan dan persentase gender
        $totalKaryawan = Karyawan::count();
        $femaleCount = Karyawan::where('jenis_kelamin', 'P')->count();
        $maleCount = Karyawan::where('jenis_kelamin', 'L')->count();

        // Hitung persentase
        $femalePercentage = $totalKaryawan > 0 ? round(($femaleCount / $totalKaryawan) * 100, 2) : 0;
        $malePercentage = $totalKaryawan > 0 ? round(($maleCount / $totalKaryawan) * 100, 2) : 0;

        return response()->json([
            'female' => $femalePercentage,
            'male' => $malePercentage,
            'total' => $totalKaryawan
        ]);
    }

    public function getReligion()
    {
        // Query menghitung total karyawan dan persentase agama
        $totalKaryawan = Karyawan::count();
        $islamCount = Karyawan::join('master_agama', 'karyawan.id_agama', '=', 'master_agama.id_agama')->where('agama', 'Islam')->count();
        $kristenCount = Karyawan::join('master_agama', 'karyawan.id_agama', '=', 'master_agama.id_agama')->where('agama', 'Kristen')->count();
        $katolikCount = Karyawan::join('master_agama', 'karyawan.id_agama', '=', 'master_agama.id_agama')->where('agama', 'Katolik')->count();
        $hinduCount = Karyawan::join('master_agama', 'karyawan.id_agama', '=', 'master_agama.id_agama')->where('agama', 'Hindu')->count();
        $buddhaCount = Karyawan::join('master_agama', 'karyawan.id_agama', '=', 'master_agama.id_agama')->where('agama', 'Buddha')->count();

        // Hitung persentase
        $islamPercentage = $totalKaryawan > 0 ? round(($islamCount / $totalKaryawan) * 100, 2) : 0;
        $kristenPercentage = $totalKaryawan > 0 ? round(($kristenCount / $totalKaryawan) * 100, 2) : 0;
        $katolikPercentage = $totalKaryawan > 0 ? round(($katolikCount / $totalKaryawan) * 100, 2) : 0;
        $hinduPercentage = $totalKaryawan > 0 ? round(($hinduCount / $totalKaryawan) * 100, 2) : 0;
        $buddhaPercentage = $totalKaryawan > 0 ? round(($buddhaCount / $totalKaryawan) * 100, 2) : 0;

        return response()->json([
            'islam' => $islamPercentage,
            'kristen' => $kristenPercentage,
            'katolik' => $katolikPercentage,
            'hindu' => $hinduPercentage,
            'buddha' => $buddhaPercentage,
            'total' => $totalKaryawan
        ]);
    }
}

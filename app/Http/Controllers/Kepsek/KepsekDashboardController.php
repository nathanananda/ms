<?php

namespace App\Http\Controllers\Kepsek;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use App\Models\MasterStatusKaryawan;
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

        return view('kepsek.dashboard', [
            'countKaryawan' => $countKaryawan,
            'countStatus' => $countStatus
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

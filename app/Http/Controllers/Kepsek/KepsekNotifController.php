<?php

namespace App\Http\Controllers\Kepsek;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use App\Models\Notif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KepsekNotifController extends Controller
{
    public function index()
    {
        $dataPribadi = Karyawan::select(
            'karyawan.id_karyawan',
            'karyawan.nama_lengkap',
        )->where('karyawan.email_pribadi', Auth::user()->email)->first();

        $dataNotification = Notif::where('notif_owner', $dataPribadi->id_karyawan)->get();

        $UnreadNotif = Notif::where('notif_owner', $dataPribadi->id_karyawan)->where('is_read', 0)->count();
        $AllNotif = Notif::where('notif_owner', $dataPribadi->id_karyawan)->count();

        return view('kepsek.notification', [
            'dataPribadi' => $dataPribadi,
            'Notif' => $dataNotification,
            'UnreadNotif' => $UnreadNotif,
            'AllNotif' => $AllNotif
        ]);
    }

    public function updateRead($id)
    {
        try {
            $data = Notif::where('id_notif', $id)->first();
            $data->is_read = 1;
            $data->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Notifikasi berhasil dibaca!',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat membaca notifikasi.',
            ], 500);
        }
    }
}

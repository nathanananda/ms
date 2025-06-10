<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserFinansialController extends Controller
{
    public function index()
    {
        $dataPribadi = Karyawan::select(
            'karyawan.id_karyawan',
            'karyawan.nama_lengkap',
        )->where('karyawan.email_pribadi', Auth::user()->email)->first();

        $dataPenggajian = Karyawan::select(
            'karyawan.id_karyawan',
            'p.*',
            'jt.jenis_tunjangan'
        )->join('penggajian as p', 'p.id_karyawan', '=', 'karyawan.id_karyawan')
            ->leftJoin('tunjangan_karyawan as tk', 'tk.id_penggajian', '=', 'p.id_penggajian')
            ->leftJoin('jenis_tunjangan as jt', 'jt.id_jenis_tunjangan', '=', 'tk.id_jenis_tunjangan')
        ->where('karyawan.email_pribadi', Auth::user()->email)->first();


        return view('user.finansial', [
            'dataPribadi' => $dataPribadi,
            'dataPenggajian' => $dataPenggajian
        ]);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $countKaryawan = Karyawan::count();
        return view('admin.dashboard', [
            'countKaryawan' => $countKaryawan
        ]);
    }
}

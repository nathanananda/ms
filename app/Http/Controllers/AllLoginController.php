<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AllLoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');



        $user = User::join('karyawan', 'karyawan.email_pribadi', '=', 'users.email')->where('users.email', $credentials['email'])->first();
        if ( $user->status_aktif == 0) {
            return redirect()->route('login')->with('toast_error', 'Akun anda sudah dinonaktifkan');
        }

        if ($user && Hash::check($credentials['password'], $user->password)) {
            Auth::login($user);
            session()->put('email', $user->email);
            session()->put('name', $user->nama_lengkap);
            if ($user->is_changepass == true) {
                if ($user->role == 'kepsek') {
                    return redirect()->route('kepsek.dashboard')->with('toast_success', 'Login Berhasil !');
                } elseif ($user->role == 'admin') {
                    return redirect()->route('admin.dashboard')->with('toast_success', 'Login Berhasil !');
                } else if ($user->role == 'user') {
                    return redirect()->route('user.profile')->with('toast_success', 'Login Berhasil !');
                } else {
                    return redirect()->route('login')->with('toast_error', 'Role tidak ditemukan');
                }
            } else {
                return redirect()->route('change-password')->with('toast_success', 'Autentikasi berhasil, Silahkan ganti password');
            }
        }

        return redirect()->back()->with('toast_error', 'Email atau password salah.');
    }

    public function storeChangePass(Request $request)
    {
        try {
            $request->validate([
                'old_password' => 'required',
                'new_password' => 'required',
                'confirm_new_password' => 'required',
            ]);

            $user = auth()->user();

            if (!Hash::check($request->old_password, $user->password)) {
                return back()->with('toast_error', 'Password lama salah');
            }

            $dataUser = User::find($user->id);
            $dataUser->is_changepass = true;
            $dataUser->password = Hash::make($request->new_password);
            $dataUser->save();

            if ($user->role == 'kepsek') {
                return redirect()->route('kepsek.dashboard')->with('toast_success', 'Kata Sandi Berhasil Diubah !');
            } elseif ($user->role == 'admin') {
                return redirect()->route('admin.dashboard')->with('toast_success', 'Kata Sandi Berhasil Diubah !');
            } else if ($user->role == 'user') {
                return redirect()->route('user.profile')->with('toast_success', 'Kata Sandi Berhasil Diubah !');
            } else {
                return redirect()->route('login')->with('toast_error', 'Role tidak ditemukan');
            }
        } catch (\Throwable $th) {
            return back()->with('toast_error', $th->getMessage());
        }
    }

    public function changePass()
    {
        return view('auth.change-pass');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('toast_success', 'Berhasil Logout !');
    }
}

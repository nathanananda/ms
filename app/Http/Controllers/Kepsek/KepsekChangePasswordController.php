<?php

namespace App\Http\Controllers\Kepsek;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class KepsekChangePasswordController extends Controller
{
    public function index()
    {
        return view('kepsek.change-pw');
    }

    public function StoreChangePass(Request $request)
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

            if ($request->new_password != $request->confirm_new_password) {
                return back()->with('toast_error', 'Password baru dan konfirmasi password tidak cocok');
            }


            $dataUser = User::find($user->id);
            $dataUser->password = Hash::make($request->new_password);
            $dataUser->save();
            return redirect()->route('kepsek.profile')->with('toast_success', 'Password berhasil diubah !');
        } catch (\Throwable $th) {
            return back()->with('toast_error', 'Password gagal diubah !');
        }
    }
}

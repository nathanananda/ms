<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\History;
use App\Models\Karyawan;
use App\Models\Kepegawaian;
use App\Models\KontrakKaryawan;
use App\Models\MasterJabatan;
use App\Models\MasterStatusKaryawan;
use App\Models\Notif;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdminOffboardingController extends Controller
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
            $d->akhir_kontrak = Carbon::parse($d->akhir_kontrak)->format('d F Y');
            $d->sisa_kontrak = Carbon::parse($d->akhir_kontrak)->diffInDays(Carbon::now());
        }

        return view('admin.offboarding.index', [
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

        return view('admin.offboarding.perpanjang', [
            'dataKaryawan' => $dataKaryawan
        ]);
    }

    public function perpanjangStore(Request $request)
    {
        try {
            $data = $request->except('_token', 'nik', 'nama_lengkap', 'jabatan', 'status_karyawan');
            if ($request->hasFile('file_kontrak')) {
                $file = $request->file('file_kontrak');
                $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
                // Simpan ke folder storage/app/profile
                $path = $file->storeAs('public/file_kontrak', $filename);
                $data['file_kontrak'] = $filename;
            }
            $data['uuid'] = Str::uuid();
            $data['status_kontrak'] = 0;
            $data['tipe_kontrak'] = 'Perpanjang';
            KontrakKaryawan::create($data);


            $dataAdmin = Karyawan::where('email_pribadi', Auth::user()->email)->first();
            Notif::create([
                'id_notif' => Str::uuid(),
                'notif_owner' => $dataAdmin->id_karyawan,
                'message' => 'Anda Mengajukan Perpanjang Kontrak : ' . $request->nama_lengkap,
                'is_read' => 0,
                'type' => 2,
                'created_at' => now(),
            ]);

            $dataKepsek = User::join('karyawan', 'karyawan.email_pribadi', '=', 'users.email')->where('users.role', 'kepsek')->get();
            foreach ($dataKepsek as $k) {
                Notif::create([
                    'id_notif' => Str::uuid(),
                    'notif_owner' => $k->id_karyawan,
                    'message' => 'Admin : ' . session('name') . 'Mengajukan Perpanjang Kontrak : ' . $request->nama_lengkap,
                    'is_read' => 0,
                    'type' => 2,
                    'created_at' => now(),
                ]);
            }
            return redirect()->route('admin.offboarding')->with('toast_success', 'Perpanjang berhasil ditambahkan, menunggu approval kepsek !');
        } catch (\Exception $e) {
            return redirect()->route('admin.offboarding')->with('toast_error', $e->getMessage());
        }
    }

    public function pengangkatanStore(Request $request)
    {
        DB::beginTransaction();

        try {
            // Ambil data lama karyawan
            $karyawan = Karyawan::where('id_karyawan', $request->id_karyawan)->first();
            $dataKepegawaian = Kepegawaian::where('id_karyawan', $request->id_karyawan)->first();
            if (!$karyawan) {
                throw new \Exception('Data karyawan tidak ditemukan.');
            }

            // Simpan perubahan status_kontrak ke history
            if ($dataKepegawaian->id_status_karyawan != $request->id_status_karyawan) {
                History::create([
                    'id_history' => Str::uuid(),
                    'id_karyawan' => $request->id_karyawan,
                    'field' => 'id_status_karyawan',
                    'value_lama' => $karyawan->id_status_karyawan,
                    'value_baru' => $request->id_status_karyawan,
                    'data_table' => 'kepegawaian',
                    'approval' => 0,
                    'created_at' => now(),
                ]);
            }

            if ($dataKepegawaian->id_jabatan != $request->id_jabatan) {
                History::create([
                    'id_history' => Str::uuid(),
                    'id_karyawan' => $request->id_karyawan,
                    'field' => 'id_jabatan',
                    'value_lama' => $karyawan->id_jabatan,
                    'value_baru' => $request->id_jabatan,
                    'data_table' => 'kepegawaian',
                    'approval' => 0,
                    'created_at' => now(),
                ]);
            }
            // Simpan perubahan jabatan ke history

            // Simpan ke tabel kontrak
            $dataKontrak = $request->except('_token', 'nik', 'nama_lengkap', 'id_jabatan', 'id_status_karyawan');
            $dataKontrak['uuid'] = Str::uuid();
            $dataKontrak['status_kontrak'] = 0;
            $dataKontrak['tipe_kontrak'] = 'Pengangkatan';
            $dataKontrak['id_karyawan'] = $request->id_karyawan;
            $dataKontrak['awal_kontrak'] = $request->awal_kontrak;
            if ($request->has('file_kontrak')) {
                $file = $request->file('file_kontrak');
                $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
                // Simpan ke folder storage/app/profile
                $path = $file->storeAs('public/file_kontrak', $filename);
                $dataKontrak['file_kontrak'] = $filename;
            }

            KontrakKaryawan::create($dataKontrak);

            $dataKepsek = User::join('karyawan', 'karyawan.id_karyawan', '=', 'user.id_karyawan')->where('users.role', 'kepsek')->get();
            foreach ($dataKepsek as $k) {
                Notif::create([
                    'id_notif' => Str::uuid(),
                    'notif_owner' => $k->id_karyawan,
                    'message' => 'Admin : ' . session('name') . 'Mengajukan Pengangkatan : ' . $karyawan->nama_lengkap,
                    'is_read' => 0,
                    'type' => 2,
                    'created_at' => now(),
                ]);
            }

            DB::commit();
            return redirect()->route('admin.offboarding')->with('toast_success', 'Kontrak pengangkatan berhasil disimpan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.offboarding')->with('toast_error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }


    public function pemberhentianStore(Request $request)
    {
        try {
            DB::beginTransaction();
            // Simpan ke tabel kontrak
            $dataKontrak = KontrakKaryawan::where('uuid', $request->id_kontrak)->join('karyawan', 'karyawan.id_karyawan', '=', 'kontrak_karyawan.id_karyawan')->first();
            if (!$dataKontrak) {
                throw new \Exception('Data kontrak tidak ditemukan.');
            }
            $dataKontrak->status_kontrak = 0;
            $dataKontrak->tipe_kontrak = 'Pemberhentian';
            if ($request->has('file_kontrak')) {
                $file = $request->file('file_kontrak');
                $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
                // Simpan ke folder storage/app/profile
                $path = $file->storeAs('public/file_kontrak', $filename);
                $dataKontrak->file_kontrak = $filename;
            }
            $dataKontrak->save();

            History::create([
                'id_history' => Str::uuid(),
                'id_karyawan' => $request->id_karyawan,
                'field' => 'status_aktif',
                'value_lama' => 1,
                'value_baru' => 0,
                'data_table' => 'karyawan',
                'approval' => 0,
                'created_at' => now(),
            ]);

            $dataKepsek = User::join('karyawan', 'karyawan.id_karyawan', '=', 'user.id_karyawan')->where('users.role', 'kepsek')->get();
            foreach ($dataKepsek as $k) {
                Notif::create([
                    'id_notif' => Str::uuid(),
                    'notif_owner' => $k->id_karyawan,
                    'message' => 'Admin : ' . session('name') . 'Mengajukan Pemberhentian : ' . $dataKontrak->nama_lengkap,
                    'is_read' => 0,
                    'type' => 2,
                    'created_at' => now(),
                ]);
            }

            DB::commit();
            return redirect()->route('admin.offboarding')->with('toast_success', 'Kontrak pemberhentian berhasil disimpan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.offboarding')->with('toast_error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
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

        return view('admin.offboarding.pengangkatan', [
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

        return view('admin.offboarding.layoff', [
            'dataKaryawan' => $dataKaryawan,
            'dataJabatan' => $dataJabatan,
            'dataStatus' => $dataStatus
        ]);
    }
}

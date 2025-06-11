<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\History;
use App\Models\Karyawan;
use App\Models\Kepegawaian;
use App\Models\KontrakKaryawan;
use App\Models\MasterAgama;
use App\Models\MasterJabatan;
use App\Models\MasterStatusKaryawan;
use App\Models\Notif;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdminLaporanController extends Controller
{
    public function index($name)
    {
        $dateNow = date('d/m/y');
        $data = KontrakKaryawan::select(
            'k.id_karyawan',
            'kontrak_karyawan.*',
            'k.nama_lengkap',
            'mj.jabatan',
            'msk.status_karyawan',
        )
            ->join('karyawan as k', 'k.id_karyawan', '=', 'kontrak_karyawan.id_karyawan')
            ->join('kepegawaian as ke', 'ke.id_karyawan', '=', 'k.id_karyawan')
            ->join('master_status_karyawan as msk', 'ke.id_status_karyawan', '=', 'msk.id_status_karyawan')
            ->join('master_jabatan as mj', 'ke.id_jabatan', '=', 'mj.id_jabatan')
            ->where('status_kontrak', Str::lower($name))->get();
        return view('admin.laporan', [
            'title' => $name,
            'dateNow' => $dateNow,
            'data' => $data
        ]);
    }

    public function dataDetail($id)
    {
        $karyawan = Karyawan::select(
            'karyawan.id_karyawan',
            'karyawan.nama_lengkap',
            'jab.id_jabatan',
            'jab.jabatan',
            'msk.status_karyawan',
            'msk.id_status_karyawan',
            'kon.uuid',
            'kon.akhir_kontrak',
            'kon.awal_kontrak'
        )
            ->join('kepegawaian as peg', 'peg.id_karyawan', '=', 'karyawan.id_karyawan')
            ->join('master_jabatan as jab', 'jab.id_jabatan', '=', 'peg.id_jabatan')
            ->join('master_status_karyawan as msk', 'msk.id_status_karyawan', '=', 'peg.id_status_karyawan')
            ->join('kontrak_karyawan as kon', 'kon.id_karyawan', '=', 'peg.id_karyawan')
            ->where('karyawan.id_karyawan', $id)
            ->first();

        return response()->json($karyawan);
    }

    public function perpanjangIndex()
    {
        $listKaryawan = Karyawan::select(
            'karyawan.id_karyawan',
            'karyawan.nama_lengkap',
            'k.nik_karyawan'
        )->join('kepegawaian as k', 'k.id_karyawan', '=', 'karyawan.id_karyawan')->where('status_aktif', True)->get();

        return view('admin.laporan.perpanjang', [
            'listKaryawan' => $listKaryawan
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

            $dataAdmin = Karyawan::where('email_pribadi', Auth::user()->email)->first();
            Notif::create([
                'id_notif' => Str::uuid(),
                'notif_owner' => $dataAdmin->id_karyawan,
                'message' => 'Anda Mengajukan Perpanjang Kontrak : ' . $request->nama_lengkap,
                'is_read' => 0,
                'type' => 2,
                'created_at' => now(),
            ]);

            return redirect()->route('admin.laporan.perpanjang')->with('toast_success', 'Perpanjang berhasil ditambahkan, menunggu approval kepsek !');
        } catch (\Exception $e) {
            return redirect()->route('admin.laporan.perpanjang')->with('toast_error', $e->getMessage());
        }
    }

    public function pengangkatanIndex()
    {
        $listKaryawan = Karyawan::select(
            'karyawan.id_karyawan',
            'karyawan.nama_lengkap',
            'k.nik_karyawan'
        )->join('kepegawaian as k', 'k.id_karyawan', '=', 'karyawan.id_karyawan')->where('status_aktif', True)->get();

        $dataJabatan = MasterJabatan::all();
        $dataStatus = MasterStatusKaryawan::all();
        return view('admin.laporan.pengangkatan', [
            'listKaryawan' => $listKaryawan,
            'dataJabatan' => $dataJabatan,
            'dataStatus' => $dataStatus
        ]);
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

            $dataKepsek = User::join('karyawan', 'karyawan.email_pribadi', '=', 'users.email')->where('users.role', 'kepsek')->get();
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

            $dataAdmin = Karyawan::where('email_pribadi', Auth::user()->email)->first();
            Notif::create([
                'id_notif' => Str::uuid(),
                'notif_owner' => $dataAdmin->id_karyawan,
                'message' => 'Anda Mengajukan Pengangkatan Kontrak : ' . $request->nama_lengkap,
                'is_read' => 0,
                'type' => 2,
                'created_at' => now(),
            ]);


            DB::commit();
            return redirect()->back()->with('toast_success', 'Kontrak pengangkatan berhasil disimpan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function pemberhentianIndex()
    {
        $listKaryawan = Karyawan::select(
            'karyawan.id_karyawan',
            'karyawan.nama_lengkap',
            'k.nik_karyawan'
        )->join('kepegawaian as k', 'k.id_karyawan', '=', 'karyawan.id_karyawan')->where('status_aktif', True)->get();

        return view('admin.laporan.pemberhentian', [
            'listKaryawan' => $listKaryawan
        ]);
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

            $dataKepsek = User::join('karyawan', 'karyawan.email_pribadi', '=', 'users.email')->where('users.role', 'kepsek')->get();
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

            $dataAdmin = Karyawan::where('email_pribadi', Auth::user()->email)->first();
            Notif::create([
                'id_notif' => Str::uuid(),
                'notif_owner' => $dataAdmin->id_karyawan,
                'message' => 'Anda Mengajukan Pemberhentian Kontrak : ' . $request->nama_lengkap,
                'is_read' => 0,
                'type' => 2,
                'created_at' => now(),
            ]);


            DB::commit();
            return redirect()->back()->with('toast_success', 'Kontrak pemberhentian berhasil disimpan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function persetujuanIndex()
    {
        $dataPengajuan = History::select(
            'history.*',
            'k.nama_lengkap',
            'jab.jabatan',
            'sk.status_karyawan'
        )->join('karyawan as k', 'k.id_karyawan', '=', 'history.id_karyawan')
            ->join('kepegawaian as peg', 'peg.id_karyawan', '=', 'k.id_karyawan')
            ->join('master_jabatan as jab', 'jab.id_jabatan', '=', 'peg.id_jabatan')
            ->join('master_status_karyawan as sk', 'sk.id_status_karyawan', '=', 'peg.id_status_karyawan')
            ->where('history.approval', '=', 0)->get();

        return view('admin.laporan.persetujuan', [
            'dataPengajuan' => $dataPengajuan
        ]);
    }

    public function approvalPerubahanData(Request $request)
    {
        try {
            $data = History::where('id_history', $request->id_history)->first();

            if ($data->data_table == 'karyawan') {
                $field = $data->field;
                $dataKaryawan = Karyawan::where('id_karyawan', $data->id_karyawan)->first();
                if ($field == 'id_agama') {
                    $MasterAgama = MasterAgama::where('agama', $data->value_baru)->first();
                    $dataKaryawan->id_agama = $MasterAgama->id_agama;
                    $dataKaryawan->save();
                } else {
                    $dataKaryawan->$field = $data->value_baru;
                    $dataKaryawan->save();
                }
            } elseif ($data->data_table == 'kepegawaian') {
                $field = $data->field;
                $dataKepegawaian = Kepegawaian::where('id_karyawan', $data->id_karyawan)->first();

                $dataKepegawaian->$field = $data->value_baru;
                $dataKepegawaian->save();
            } else if ($data->data_table == 'kontrak') {
                $field = $data->field;
                $dataKontrak = KontrakKaryawan::where('id_kontrak', $data->id_karyawan)->first();
                $dataKontrak->$field = $data->value_baru;
                $dataKontrak->save();
            }

            $data->approval = 2;
            $data->save();

            Notif::create([
                'id_notif' => Str::uuid(),
                'notif_owner' => $data->id_karyawan,
                'message' => session('name') . 'telah menyetujui perubahan data : ' . $data->field,
                'is_read' => 0,
                'type' => 1,
                'created_at' => now(),
            ]);

            return redirect()->route('admin.laporan.persetujuan')->with('toast_success', 'Data berhasil disetujui !');
        } catch (\Exception $e) {
            return redirect()->route('admin.laporan.persetujuan')->with('toast_error', $e->getMessage());
        }
    }

    public function rejectPerubahanData(Request $request)
    {
        try {
            $data = History::where('id_history', $request->id_history)->first();
            $data->approval = 1;
            $data->save();

            Notif::create([
                'id_notif' => Str::uuid(),
                'notif_owner' => $data->id_karyawan,
                'message' => session('name') . 'tidak menyetujui perubahan data : ' . $data->field,
                'is_read' => 0,
                'type' => 1,
                'created_at' => now(),
            ]);

            return redirect()->route('admin.laporan.persetujuan')->with('toast_success', 'Data berhasil ditolak !');
        } catch (\Exception $e) {
            return redirect()->route('admin.laporan.persetujuan')->with('toast_error', $e->getMessage());
        }
    }
}

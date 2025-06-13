<?php

namespace App\Http\Controllers\Kepsek;

use App\Http\Controllers\Controller;
use App\Models\History;
use App\Models\Karyawan;
use App\Models\Kepegawaian;
use App\Models\KontakDarurat;
use App\Models\KontrakKaryawan;
use App\Models\MasterJabatan;
use App\Models\MasterStatusKaryawan;
use App\Models\Notif;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class KepsekLaporanController extends Controller
{
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

        return view('kepsek.laporan.perpanjang', [
            'listKaryawan' => $listKaryawan
        ]);
    }

    public function perpanjangStore(Request $request)
    {
        try {
            $data = $request->except('_token', 'nik', 'nama_lengkap', 'jabatan', 'status_karyawan');

            $dataKontrakLama = KontrakKaryawan::where('id_karyawan', $request->id_karyawan)->where('status_kontrak', 1)->first();
            $dataKontrakLama->status_kontrak = 0;
            $dataKontrakLama->save();

            if ($request->hasFile('file_kontrak')) {
                $file = $request->file('file_kontrak');
                $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
                // Simpan ke folder storage/app/profile
                $path = $file->storeAs('public/file_kontrak', $filename);
                $data['file_kontrak'] = $filename;
            }

            $data['uuid'] = Str::uuid();
            $data['id_karyawan'] = $request->id_karyawan;
            $data['awal_kontrak'] = $request->awal_kontrak;
            $data['akhir_kontrak'] = $request->akhir_kontrak;
            $data['status_kontrak'] = 1;
            $data['tipe_kontrak'] = 'Perpanjang';
            KontrakKaryawan::create($data);

            $dataAdmin = User::join('karyawan', 'karyawan.email_pribadi', '=', 'users.email')->where('users.role', 'admin')->get();
            foreach ($dataAdmin as $k) {
                Notif::create([
                    'id_notif' => Str::uuid(),
                    'notif_owner' => $k->id_karyawan,
                    'message' => 'Kepsek : ' . session('name') . 'Memperpanjang Kontrak : ' . $request->nama_lengkap,
                    'is_read' => 0,
                    'type' => 2,
                    'created_at' => now(),
                ]);
            }

            $dataKepsek = Karyawan::where('email_pribadi', Auth::user()->email)->first();
            Notif::create([
                'id_notif' => Str::uuid(),
                'notif_owner' => $dataKepsek->id_karyawan,
                'message' => 'Anda Memperpanjang Kontrak : ' . $request->nama_lengkap,
                'is_read' => 0,
                'type' => 2,
                'created_at' => now(),
            ]);
            return redirect()->route('kepsek.laporan.perpanjang')->with('toast_success', 'Kontrak Berhasil Diperpanjang ! ');
        } catch (\Exception $e) {
            return redirect()->back()->with('toast_error', $e->getMessage());
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
        return view('kepsek.laporan.pengangkatan', [
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
                    'approval' => 2,
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
                    'approval' => 2,
                    'created_at' => now(),
                ]);
            }

            $dataKontrakLama = KontrakKaryawan::where('id_karyawan', $request->id_karyawan)->where('status_kontrak', 1)->first();
            $dataKontrakLama->status_kontrak = 0;
            $dataKontrakLama->tipe_kontrak = 'Nonactive';
            $dataKontrakLama->save();

            // Simpan ke tabel kontrak
            $dataKontrak = $request->except('_token', 'nik', 'nama_lengkap', 'id_jabatan', 'id_status_karyawan');
            $dataKontrak['uuid'] = Str::uuid();
            $dataKontrak['status_kontrak'] = 1;
            $dataKontrak['tipe_kontrak'] = 'Pengangkatan';
            $dataKontrak['id_karyawan'] = $request->id_karyawan;
            $dataKontrak['awal_kontrak'] = $request->awal_kontrak;
            $dataKontrak['akhir_kontrak'] = $request->akhir_kontrak;
            if ($request->has('file_kontrak')) {
                $file = $request->file('file_kontrak');
                $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
                // Simpan ke folder storage/app/profile
                $path = $file->storeAs('public/file_kontrak', $filename);
                $dataKontrak['file_kontrak'] = $filename;
            }
            KontrakKaryawan::create($dataKontrak);

            // Simpan ke tabel kepegawaian
            $dataKepegawaian->id_jabatan = $request->id_jabatan;
            $dataKepegawaian->id_status_karyawan = $request->id_status_karyawan;
            $dataKepegawaian->save();

            $dataAdmin = User::join('karyawan', 'karyawan.email_pribadi', '=', 'users.email')->where('users.role', 'admin')->get();
            foreach ($dataAdmin as $k) {
                Notif::create([
                    'id_notif' => Str::uuid(),
                    'notif_owner' => $k->id_karyawan,
                    'message' => 'Kepsek : ' . session('name') . 'Melaakukan Pengangkatan Kontrak : ' . $request->nama_lengkap,
                    'is_read' => 0,
                    'type' => 2,
                    'created_at' => now(),
                ]);
            }

            $dataKepsek = Karyawan::where('email_pribadi', Auth::user()->email)->first();
            Notif::create([
                'id_notif' => Str::uuid(),
                'notif_owner' => $dataKepsek->id_karyawan,
                'message' => 'Anda Melakukan Pengangkatan Kontrak : ' . $request->nama_lengkap,
                'is_read' => 0,
                'type' => 2,
                'created_at' => now(),
            ]);

            DB::commit();
            return redirect()->back()->with('toast_success', 'Karyawan berhasil pengangkatan kontrak !');
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

        return view('kepsek.laporan.pemberhentian', [
            'listKaryawan' => $listKaryawan
        ]);
    }

    public function pemberhentianStore(Request $request)
    {
        try {
            DB::beginTransaction();
            // Simpan ke tabel kontrak
            $dataKontrak = KontrakKaryawan::where('uuid', $request->id_kontrak)->first();
            if (!$dataKontrak) {
                throw new \Exception('Data kontrak tidak ditemukan.');
            }
            $dataKontrak->status_kontrak = 1;
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
                'approval' => 2,
                'created_at' => now(),
            ]);

            $dataKaryawan = Karyawan::where('id_karyawan', $request->id_karyawan)->first();
            $dataKaryawan->status_aktif = 0;
            $dataKaryawan->tipe_kontrak = 'Nonactive';
            $dataKaryawan->save();

            $dataAdmin = User::join('karyawan', 'karyawan.email_pribadi', '=', 'users.email')->where('users.role', 'admin')->get();
            foreach ($dataAdmin as $k) {
                Notif::create([
                    'id_notif' => Str::uuid(),
                    'notif_owner' => $k->id_karyawan,
                    'message' => 'Kepsek : ' . session('name') . 'Memberhentikan Kontrak : ' . $request->nama_lengkap,
                    'is_read' => 0,
                    'type' => 2,
                    'created_at' => now(),
                ]);
            }

            $dataKepsek = Karyawan::where('email_pribadi', Auth::user()->email)->first();
            Notif::create([
                'id_notif' => Str::uuid(),
                'notif_owner' => $dataKepsek->id_karyawan,
                'message' => 'Anda Memberhentikan Kontrak : ' . $request->nama_lengkap,
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



    public function persetujuan()
    {
        $dataPersetujuanKontrak = Karyawan::select(
            'karyawan.id_karyawan',
            'karyawan.nama_lengkap',
            'msk.status_karyawan',
            'mj.jabatan',
            'kon.tipe_kontrak',
            'kon.uuid'
        )->join('kepegawaian as k', 'k.id_karyawan', '=', 'karyawan.id_karyawan')
            ->join('master_status_karyawan as msk', 'k.id_status_karyawan', '=', 'msk.id_status_karyawan')
            ->join('master_jabatan as mj', 'k.id_jabatan', '=', 'mj.id_jabatan')
            ->join('kontrak_karyawan as kon', 'kon.id_karyawan', '=', 'k.id_karyawan')
            ->where('kon.status_kontrak', 0)
            ->where('kon.catatan', null)
            ->where('kon.tipe_kontrak', '!=', 'Nonactive')
            ->where('karyawan.status_aktif', True)
            ->get();


            
        return view('kepsek.laporan.persetujuan', [
            'dataPersetujuanKontrak' => $dataPersetujuanKontrak
        ]);
    }

    public function detailPersetujuan($id)
    {
        if (empty($id)) {
            return redirect()->back()->with('toast_error', 'Invalid Data !');
        }
        $dataKaryawan = Karyawan::select(
            'karyawan.id_karyawan',
            'karyawan.nama_lengkap',
            'k.nik_karyawan',
            'msk.status_karyawan',
            'mj.jabatan',
            'kon.tipe_kontrak',
            'kon.awal_kontrak',
            'kon.akhir_kontrak',
            'kon.file_kontrak',
            'kon.uuid as id_kontrak'
        )->join('kepegawaian as k', 'k.id_karyawan', '=', 'karyawan.id_karyawan')
            ->join('master_status_karyawan as msk', 'k.id_status_karyawan', '=', 'msk.id_status_karyawan')
            ->join('master_jabatan as mj', 'k.id_jabatan', '=', 'mj.id_jabatan')
            ->join('kontrak_karyawan as kon', 'kon.id_karyawan', '=', 'k.id_karyawan')
            ->where('kon.status_kontrak', 0)
            ->where('kon.uuid', $id)->first();

        return view('kepsek.laporan.detailPersetujuan.detail-persetujuan', [
            'dataKaryawan' => $dataKaryawan
        ]);
    }

    public function approvalPerpanjangIndex($id)
    {
        if (empty($id)) {
            return redirect()->back()->with('toast_error', 'Invalid Data !');
        }
        $dataKaryawan = Karyawan::select(
            'karyawan.id_karyawan',
            'karyawan.nama_lengkap',
            'k.nik_karyawan',
            'msk.status_karyawan',
            'mj.jabatan',
            'kon.tipe_kontrak',
            'kon.awal_kontrak',
            'kon.akhir_kontrak',
            'kon.file_kontrak',
            'kon.uuid as id_kontrak'
        )->join('kepegawaian as k', 'k.id_karyawan', '=', 'karyawan.id_karyawan')
            ->join('master_status_karyawan as msk', 'k.id_status_karyawan', '=', 'msk.id_status_karyawan')
            ->join('master_jabatan as mj', 'k.id_jabatan', '=', 'mj.id_jabatan')
            ->join('kontrak_karyawan as kon', 'kon.id_karyawan', '=', 'k.id_karyawan')
            ->where('kon.status_kontrak', 0)
            ->where('kon.uuid', $id)->first();

        return view('kepsek.laporan.detailPersetujuan.form-perpanjang', [
            'dataKaryawan' => $dataKaryawan
        ]);
    }

    public function approvalPenambahanIndex($id)
    {
        if (empty($id)) {
            return redirect()->back()->with('toast_error', 'Invalid Data !');
        }
        $dataKaryawan = Karyawan::select(
            'karyawan.id_karyawan',
            'karyawan.nama_lengkap',
            'k.nik_karyawan',
            'msk.status_karyawan',
            'mj.jabatan',
            'kon.tipe_kontrak',
            'kon.awal_kontrak',
            'kon.akhir_kontrak',
            'kon.file_kontrak',
            'kon.uuid as id_kontrak'
        )->join('kepegawaian as k', 'k.id_karyawan', '=', 'karyawan.id_karyawan')
            ->join('master_status_karyawan as msk', 'k.id_status_karyawan', '=', 'msk.id_status_karyawan')
            ->join('master_jabatan as mj', 'k.id_jabatan', '=', 'mj.id_jabatan')
            ->join('kontrak_karyawan as kon', 'kon.id_karyawan', '=', 'k.id_karyawan')
            ->where('kon.status_kontrak', 0)
            ->where('kon.uuid', $id)->first();

        return view('kepsek.laporan.detailPersetujuan.form-penambahan', [
            'dataKaryawan' => $dataKaryawan
        ]);
    }

    public function approvePenambahanKaryawan(Request $request)
    {
        try {
            $id = $request->id_kontrak;
            KontrakKaryawan::where('uuid', $id)->update([
                'status_kontrak' => 1
            ]);

            $dataKaryawan = Karyawan::where('id_karyawan', $request->id_karyawan)->first();
            $dataKaryawan->update([
                'status_aktif' => True,
                'approval_kepsek' => 2
            ]);
            return redirect()->route('kepsek.laporan.persetujuan')->with('toast_success', 'Penambahan Karyawan Berhasil Disetujui !');
        } catch (\Exception $e) {
            return redirect()->route('kepsek.laporan.persetujuan')->with('toast_error', 'Penambahan Karyawan Gagal Disetujui ! : ' . $e->getMessage());
        }
    }

    public function approvalPengangkatanIndex($id)
    {
        $dataJabatan = MasterJabatan::all();
        $dataStatus = MasterStatusKaryawan::all();


        if (empty($id)) {
            return redirect()->back()->with('toast_error', 'Invalid Data !');
        }
        $dataKaryawan = Karyawan::select(
            'karyawan.id_karyawan',
            'karyawan.nama_lengkap',
            'k.nik_karyawan',
            'msk.status_karyawan',
            'mj.jabatan',
            'kon.tipe_kontrak',
            'kon.awal_kontrak',
            'kon.akhir_kontrak',
            'kon.file_kontrak',
            'kon.uuid as id_kontrak'
        )->join('kepegawaian as k', 'k.id_karyawan', '=', 'karyawan.id_karyawan')
            ->join('master_status_karyawan as msk', 'k.id_status_karyawan', '=', 'msk.id_status_karyawan')
            ->join('master_jabatan as mj', 'k.id_jabatan', '=', 'mj.id_jabatan')
            ->join('kontrak_karyawan as kon', 'kon.id_karyawan', '=', 'k.id_karyawan')
            ->where('kon.status_kontrak', 0)
            ->where('kon.uuid', $id)->first();


        return view('kepsek.laporan.detailPersetujuan.form-pengangkatan', [
            'dataJabatan' => $dataJabatan,
            'dataStatus' => $dataStatus,
            'dataKaryawan' => $dataKaryawan
        ]);
    }


    public function approvalPemberhentianIndex($id)
    {
        if (empty($id)) {
            return redirect()->back()->with('toast_error', 'Invalid Data !');
        }
        $dataKaryawan = Karyawan::select(
            'karyawan.id_karyawan',
            'karyawan.nama_lengkap',
            'k.nik_karyawan',
            'msk.status_karyawan',
            'msk.id_status_karyawan',
            'mj.jabatan',
            'mj.id_jabatan',
            'kon.tipe_kontrak',
            'kon.awal_kontrak',
            'kon.akhir_kontrak',
            'kon.file_kontrak',
            'kon.uuid as id_kontrak'
        )->join('kepegawaian as k', 'k.id_karyawan', '=', 'karyawan.id_karyawan')
            ->join('master_status_karyawan as msk', 'k.id_status_karyawan', '=', 'msk.id_status_karyawan')
            ->join('master_jabatan as mj', 'k.id_jabatan', '=', 'mj.id_jabatan')
            ->join('kontrak_karyawan as kon', 'kon.id_karyawan', '=', 'k.id_karyawan')
            ->where('kon.status_kontrak', 0)
            ->where('kon.uuid', $id)->first();

        return view('kepsek.laporan.detailPersetujuan.form-pemberhentian', [
            'dataKaryawan' => $dataKaryawan
        ]);
    }


    public function rejectKontrak(Request $request)
    {
        try {
            $data = KontrakKaryawan::join('karyawan as k', 'k.id_karyawan', '=', 'kontrak_karyawan.id_karyawan')->where('uuid', $request->id_kontrak)->first();
            // dd($request->catatan);
            $data->catatan = $request->catatan;
            $data->save();

            $dataAdmin = User::join('karyawan', 'karyawan.email_pribadi', '=', 'users.email')->where('users.role', 'admin')->get();
            foreach ($dataAdmin as $k) {
                Notif::create([
                    'id_notif' => Str::uuid(),
                    'notif_owner' => $k->id_karyawan,
                    'message' => 'Kepsek : ' . session('name') . ' Menolak Update Kontrak : ' . $data->nama_lengkap . '. Catatan : ' . $request->catatan,
                    'is_read' => 0,
                    'type' => 2,
                    'created_at' => now(),
                ]);
            }

            $dataKepsek = Karyawan::where('email_pribadi', Auth::user()->email)->first();
            Notif::create([
                'id_notif' => Str::uuid(),
                'notif_owner' => $dataKepsek->id_karyawan,
                'message' => 'Anda Menolak Update Kontrak : ' . $data->nama_lengkap . '. Catatan : ' . $request->catatan,
                'is_read' => 0,
                'type' => 2,
                'created_at' => now(),
            ]);

            return redirect()->route('kepsek.laporan.persetujuan')->with('toast_success', 'Kontrak berhasil ditolak !');
        } catch (\Exception $e) {
            return redirect()->route('kepsek.laporan.persetujuan')->with('toast_error', 'Oncurred Error : ' . $e->getMessage());
        }
    }

    public function approvePerpanjang(Request $request)
    {
        try {
            $dataKontrakLama = KontrakKaryawan::where('id_karyawan', $request->id_karyawan)->where('status_kontrak', 1)->first();
            if ($dataKontrakLama) {
                $dataKontrakLama->status_kontrak = 0;
                $dataKontrakLama->save();
            }

            $dataKontrak = KontrakKaryawan::join('karyawan as k', 'k.id_karyawan', '=', 'kontrak_karyawan.id_karyawan')->where('uuid', $request->id_kontrak)->first();
            $dataKontrak->status_kontrak = 1;
            $dataKontrak->save();

            $dataAdmin = User::join('karyawan', 'karyawan.email_pribadi', '=', 'users.email')->where('users.role', 'admin')->get();
            foreach ($dataAdmin as $k) {
                Notif::create([
                    'id_notif' => Str::uuid(),
                    'notif_owner' => $k->id_karyawan,
                    'message' => 'Kepsek : ' . session('name') . ' Menyetujui Perpanjang Kontrak : ' . $dataKontrak->nama_lengkap,
                    'is_read' => 0,
                    'type' => 2,
                    'created_at' => now(),
                ]);
            }

            $dataKepsek = Karyawan::where('email_pribadi', Auth::user()->email)->first();
            Notif::create([
                'id_notif' => Str::uuid(),
                'notif_owner' => $dataKepsek->id_karyawan,
                'message' => 'Anda Menyetujui Perpanjang Kontrak : ' . $dataKontrak->nama_lengkap,
                'is_read' => 0,
                'type' => 2,
                'created_at' => now(),
            ]);

            return redirect()->route('kepsek.laporan.persetujuan')->with('toast_success', 'Perpanjang berhasil disetujui !');
        } catch (\Exception $e) {
            return redirect()->route('kepsek.laporan.persetujuan')->with('toast_error', 'Oncurred Error : ' . $e->getMessage());
        }
    }

    public function approvePemberhentian(Request $request)
    {
        try {
            $dataKontrak = KontrakKaryawan::where('uuid', $request->id_kontrak)->first();
            $dataKontrak->status_kontrak = 0;
            $dataKontrak->save();

            $dataKaryawan = Karyawan::where('id_karyawan', $request->id_karyawan)->first();
            $dataKaryawan->status_aktif = 0;
            $dataKaryawan->save();

            $dataAdmin = User::join('karyawan', 'karyawan.email_pribadi', '=', 'users.email')->where('users.role', 'admin')->get();
            foreach ($dataAdmin as $k) {
                Notif::create([
                    'id_notif' => Str::uuid(),
                    'notif_owner' => $k->id_karyawan,
                    'message' => 'Kepsek : ' . session('name') . 'Menyetujui Pemberhentian Kontrak : ' . $dataKaryawan->nama_lengkap,
                    'is_read' => 0,
                    'type' => 2,
                    'created_at' => now(),
                ]);
            }

            $dataKepsek = Karyawan::where('email_pribadi', Auth::user()->email)->first();
            Notif::create([
                'id_notif' => Str::uuid(),
                'notif_owner' => $dataKepsek->id_karyawan,
                'message' => 'Anda Menyetujui Pemberhentian Kontrak : ' . $dataKaryawan->nama_lengkap,
                'is_read' => 0,
                'type' => 2,
                'created_at' => now(),
            ]);

            return redirect()->route('kepsek.laporan.persetujuan')->with('toast_success', 'Pemberhentian berhasil disetujui !');
        } catch (\Exception $e) {
            return redirect()->route('kepsek.laporan.persetujuan')->with('toast_error', 'Oncurred Error : ' . $e->getMessage());
        }
    }

    public function approvePengangkatan(Request $request)
    {
        try {
            $dataKontrakLama = KontrakKaryawan::where('id_karyawan', $request->id_karyawan)->where('status_kontrak', 1)->first();
            if ($dataKontrakLama) {
                $dataKontrakLama->status_kontrak = 0;
                $dataKontrakLama->save();
            }

            $dataKontrak = KontrakKaryawan::join('karyawan as k', 'k.id_karyawan', '=', 'kontrak_karyawan.id_karyawan')->where('uuid', $request->id_kontrak)->first();
            $dataKontrak->status_kontrak = 1;
            $dataKontrak->save();

            $dataHistory = History::where('id_karyawan', $request->id_karyawan)->where('approval', 0)->get();
            foreach ($dataHistory as $item) {
                $field = $item->field;
                if ($item->data_table == 'kepegawaian') {
                    $dataKepegawaian = Kepegawaian::where('id_karyawan', $item->id_karyawan)->first();
                    $dataKepegawaian->$field = $item->value_baru;
                    $dataKepegawaian->save();
                } else if ($item->data_table == 'karyawan') {
                    $dataKaryawan = Karyawan::where('id_karyawan', $item->id_karyawan)->first();
                    $dataKaryawan->$field = $item->value_baru;
                    $dataKaryawan->save();
                } else if ($item->data_table == 'kontak_darurat') {
                    $dataKontakDarurat = KontakDarurat::where('id_karyawan', $item->id_karyawan)->first();
                    $dataKontakDarurat->$field = $item->value_baru;
                    $dataKontakDarurat->save();
                }
                $item->approval = 2;
                $item->save();
            }

            $dataAdmin = User::join('karyawan', 'karyawan.email_pribadi', '=', 'users.email')->where('users.role', 'admin')->get();
            foreach ($dataAdmin as $k) {
                Notif::create([
                    'id_notif' => Str::uuid(),
                    'notif_owner' => $k->id_karyawan,
                    'message' => 'Kepsek : ' . session('name') . ' Menyetujui Pengangkatan Kontrak : ' . $dataKontrak->nama_lengkap,
                    'is_read' => 0,
                    'type' => 2,
                    'created_at' => now(),
                ]);
            }

            $dataKepsek = Karyawan::where('email_pribadi', Auth::user()->email)->first();
            Notif::create([
                'id_notif' => Str::uuid(),
                'notif_owner' => $dataKepsek->id_karyawan,
                'message' => 'Anda Menyetujui Pengangkatan Kontrak : ' . $dataKontrak->nama_lengkap,
                'is_read' => 0,
                'type' => 2,
                'created_at' => now(),
            ]);


            return redirect()->route('kepsek.laporan.persetujuan')->with('toast_success', 'Pengangkatan berhasil disetujui !');
        } catch (\Exception $e) {
            return redirect()->route('kepsek.laporan.persetujuan')->with('toast_error', 'Oncurred Error : ' . $e->getMessage());
        }
    }
}

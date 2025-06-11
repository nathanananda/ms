<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alamat;
use App\Models\History;
use App\Models\JenisTunjangan;
use App\Models\Karyawan;
use App\Models\Kepegawaian;
use App\Models\KontakDarurat;
use App\Models\KontrakKaryawan;
use App\Models\MasterAgama;
use App\Models\MasterJabatan;
use App\Models\MasterProvinsi;
use App\Models\MasterSection;
use App\Models\MasterStatusKaryawan;
use App\Models\Notif;
use App\Models\Penggajian;
use App\Models\RiwayatPendidikan;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminKaryawanController extends Controller
{
    public function TambahKaryawan()
    {
        $dataStatus = MasterStatusKaryawan::all();
        $dataJabatan = MasterJabatan::all();
        $dataTunjangan = JenisTunjangan::where('deleted_at', null)->get();
        $dataAgama = MasterAgama::all();

        $listKaryawan = Karyawan::select(
            'karyawan.id_karyawan',
            'karyawan.nama_lengkap',
            'k.nik_karyawan'
        )->join('kepegawaian as k', 'k.id_karyawan', '=', 'karyawan.id_karyawan')->where('status_aktif', True)->get();

        return view('admin.karyawan.tambah-karyawan', [
            'dataStatus' => $dataStatus,
            'dataJabatan' => $dataJabatan,
            'dataTunjangan' => $dataTunjangan,
            'listKaryawan' => $listKaryawan,
            'dataAgama' => $dataAgama
        ]);
    }

    public function StoreKaryawan(Request $request)
    {
        DB::beginTransaction();

        try {
            // Insert Karyawan
            $dataKaryawan = $request->only([
                'nama_lengkap',
                'jenis_kelamin',
                'status_aktif',
                'no_ktp',
                'no_hp',
                'email_pribadi',
                'id_agama',
                'status_nikah',
                'tempat_lahir',
                'tanggal_lahir',
                'golongan_darah',
                'tinggi_badan',
                'berat_badan',
                'kewarganegaraan'
            ]);

            $idKaryawan = $dataKaryawan['id_karyawan'] = Str::uuid();
            if ($request->hasFile('foto')) {
                // Ambil file
                $file = $request->file('foto');
                // Generate nama acak dengan ekstensi asli
                $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
                // Simpan ke folder storage/app/profile
                $path = $file->storeAs('public/profile', $filename);
                $dataKaryawan['foto'] = $filename;
            }
            Karyawan::create($dataKaryawan);

            // Insert Alamat
            $dataAlamat = $request->only([
                'alamat',
                'jenis_alamat',
                'id_kelurahan',
                'kodepos'
            ]);
            $dataAlamat['id_karyawan'] = $idKaryawan;
            $dataAlamat['id_alamat'] = Str::uuid();
            Alamat::create($dataAlamat);

            // Insert Pendidikan Karyawan
            $dataPendidikan = $request->only([
                'tingkat_pendidikan',
                'institusi',
                'jurusan',
                'tahun_masuk',
                'tahun_lulus',
                'nilai',
                'gelar',
            ]);
            $dataPendidikan['id_karyawan'] = $idKaryawan;
            $dataPendidikan['id_riwayat_pendidikan'] = Str::uuid();
            RiwayatPendidikan::create($dataPendidikan);

            $dataKontakDarurat = $request->only([
                'nomor_kontak_darurat',
                'nama_kontak_darurat',
                'hubungan_kontak_darurat'
            ]);
            $dataKontakDarurat['id_karyawan'] = $idKaryawan;
            $dataKontakDarurat['id_kontak_darurat'] = Str::uuid();
            KontakDarurat::create($dataKontakDarurat);

            $dataKepegawaian = $request->only([
                'nik_karyawan',
                'email_kantor',
                'id_status_karyawan',
                'atasan_langsung',
                'id_section',
                'id_jabatan',
            ]);
            $dataKepegawaian['id_karyawan'] = $idKaryawan;
            $dataKepegawaian['id_kepegawaian'] = Str::uuid();
            $dataKepegawaian['tanggal_masuk'] = $request->awal_kontrak;
            Kepegawaian::create($dataKepegawaian);

            $dataPenggajian = $request->only([
                'kode_golongan',
                'npwp',
                'no_rekening',
                'no_bpjs_kesehatan',
                'no_bpjs_ketenagakerjaan',
                'no_bpjs_pensiun',
            ]);

            $dataPenggajian['id_karyawan'] = $idKaryawan;
            $dataPenggajian['id_penggajian'] = Str::uuid();
            Penggajian::create($dataPenggajian);

            $dataKontrak = $request->only(['awal_kontrak', 'akhir_kontrak']);
            $dataKontrak['id_karyawan'] = $idKaryawan;
            $dataKontrak['uuid'] = Str::uuid();
            $dataKontrak['status_kontrak'] = 0;
            $dataKontrak['tipe_kontrak'] = 'Penambahan';
            if ($request->hasFile('file_kontrak')) {
                // Ambil file
                $file = $request->file('file_kontrak');
                // Generate nama acak dengan ekstensi asli
                $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
                // Simpan ke folder storage/app/profile
                $path = $file->storeAs('public/file_kontrak', $filename);
                $dataKontrak['file_kontrak'] = $filename;
            }
            KontrakKaryawan::create($dataKontrak);

            User::create([
                'id' => Str::uuid(),
                'email' => $request->email_pribadi,
                'password' => Hash::make('AdminSekolah'),
                'role' => 'user',
                'is_changepass' => 0,
            ]);

            $dataKepsek = User::join('karyawan', 'karyawan.email_pribadi', '=', 'users.email')->where('users.role', 'kepsek')->get();
            foreach ($dataKepsek as $k) {
                Notif::create([
                    'id_notif' => Str::uuid(),
                    'notif_owner' => $k->id_karyawan,
                    'message' => 'Admin : ' . session('name') . 'Mengajukan Penambahan Karyawan : ' . $request->nama_lengkap,
                    'is_read' => 0,
                    'type' => 2,
                    'created_at' => now(),
                ]);
            }

            $dataAdmin = Karyawan::where('email_pribadi', Auth::user()->email)->first();
            Notif::create([
                'id_notif' => Str::uuid(),
                'notif_owner' => $dataAdmin->id_karyawan,
                'message' => 'Anda Mengajukan Penambahan Karyawan : ' . $request->nama_lengkap,
                'is_read' => 0,
                'type' => 2,
                'created_at' => now(),
            ]);


            DB::commit();

            return redirect()->route('admin.karyawan.list', ['status' => 'all'])->with('toast_success', 'Data Berhasil Ditambahkan');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('toast_error', $e->getMessage());
        }
    }

    public function list($status)
    {
        if ($status == 'all') {
            $listData = Karyawan::select(
                'karyawan.id_karyawan',
                'karyawan.nama_lengkap',
                'master_jabatan.jabatan',
                'master_status_karyawan.status_karyawan'
            )
                ->join('kepegawaian', 'kepegawaian.id_karyawan', '=', 'karyawan.id_karyawan')
                ->join('master_jabatan', 'master_jabatan.id_jabatan', '=', 'kepegawaian.id_jabatan')
                ->join('master_status_karyawan', 'master_status_karyawan.id_status_karyawan', '=', 'kepegawaian.id_status_karyawan')
                ->where('karyawan.status_aktif', True)->paginate(12);
        } else {
            $listData = Karyawan::select(
                'karyawan.id_karyawan',
                'karyawan.nama_lengkap',
                'master_jabatan.jabatan',
                'master_status_karyawan.status_karyawan'
            )
                ->join('kepegawaian', 'kepegawaian.id_karyawan', '=', 'karyawan.id_karyawan')
                ->join('master_jabatan', 'master_jabatan.id_jabatan', '=', 'kepegawaian.id_jabatan')
                ->join('master_status_karyawan', 'master_status_karyawan.id_status_karyawan', '=', 'kepegawaian.id_status_karyawan')
                ->where('karyawan.status_aktif', True)
                ->where('master_status_karyawan.status_karyawan', $status)->paginate(12);
        }


        $StatusAll = MasterStatusKaryawan::all();
        $StatusAll = Karyawan::join('kepegawaian', 'kepegawaian.id_karyawan', '=', 'karyawan.id_karyawan')
            ->join('master_status_karyawan', 'master_status_karyawan.id_status_karyawan', '=', 'kepegawaian.id_status_karyawan')
            ->where('karyawan.status_aktif', true)
            ->select('master_status_karyawan.status_karyawan', DB::raw('count(*) as total'))
            ->groupBy('master_status_karyawan.status_karyawan')
            ->get();
        $totalAll = $StatusAll->sum('total');



        return view('admin.karyawan.list', [
            'StatusAll' => $StatusAll,
            'listData' => $listData,
            'totalAll' => $totalAll
        ]);
    }

    public function detailKaryawan($id)
    {
        $MasterAgama = MasterAgama::all();
        $dataPribadi = Karyawan::select(
            'karyawan.id_karyawan',
            'karyawan.nama_lengkap',
            'k.nik_karyawan',
            'karyawan.jenis_kelamin',
            'karyawan.no_hp',
            'karyawan.tempat_lahir',
            'karyawan.tanggal_lahir',
            'karyawan.id_agama',
            'agama.agama',
            'mj.jabatan',
            'msk.status_karyawan',
            'karyawan.status_aktif',
            'karyawan.no_ktp',
            'karyawan.email_pribadi',
            'karyawan.status_nikah',
            'karyawan.kewarganegaraan',
            'karyawan.golongan_darah',
            'karyawan.tinggi_badan',
            'karyawan.berat_badan',
        )->join('kepegawaian as k', 'k.id_karyawan', '=', 'karyawan.id_karyawan')
            ->join('master_agama as agama', 'agama.id_agama', '=', 'karyawan.id_agama')
            ->join('master_status_karyawan as msk', 'k.id_status_karyawan', '=', 'msk.id_status_karyawan')
            ->join('master_jabatan as mj', 'k.id_jabatan', '=', 'mj.id_jabatan')
            ->where('karyawan.id_karyawan', $id)->first();

        $dataProvinsi = MasterProvinsi::all();
        $dataAlamat = Alamat::select(
            'alamat.*',
            'kel.nama_kelurahan',
            'kec.nama_kecamatan',
            'kota.nama_kota',
            'prov.nama_provinsi'
        )->join('master_kelurahan as kel', 'kel.id_kelurahan', '=', 'alamat.id_kelurahan')
            ->join('master_kecamatan as kec', 'kec.id_kecamatan', '=', 'kel.id_kecamatan')
            ->join('master_kota as kota', 'kota.id_kota', '=', 'kec.id_kota')
            ->join('master_provinsi as prov', 'prov.id_provinsi', '=', 'kota.id_provinsi')
            ->where('alamat.id_karyawan', operator: $dataPribadi->id_karyawan)->first();

        $dataKontak = KontakDarurat::where('id_karyawan', operator: $dataPribadi->id_karyawan)->first();

        $dataPendidikan = RiwayatPendidikan::where('id_karyawan', operator: $dataPribadi->id_karyawan)->get();
        $dataKepegawaian = Kepegawaian::select(
            'kepegawaian.nik_karyawan',
            'kepegawaian.email_kantor',
            'msk.status_karyawan',
            'ms.nama_section',
            'md.nama_departemen',
            'div.nama_divisi',
            'mj.jabatan',
            'k.nama_lengkap',
            'kepegawaian.alasan_keluar',
        )->join('master_status_karyawan as msk', 'msk.id_status_karyawan', '=', 'kepegawaian.id_status_karyawan')
            ->join('master_jabatan as mj', 'mj.id_jabatan', '=', 'kepegawaian.id_jabatan')
            ->join('master_section as ms', 'ms.id_section', '=', 'kepegawaian.id_section')
            ->join('master_departemen as md', 'md.id_departemen', '=', 'ms.id_departemen')
            ->join('master_divisi as div', 'div.id_divisi', '=', 'md.id_divisi')
            ->join('karyawan as k', 'k.id_karyawan', '=', 'kepegawaian.atasan_langsung')
            ->where('kepegawaian.id_karyawan', operator: $id)->first();

        $dataPenggajian = Penggajian::where('id_karyawan', operator: $dataPribadi->id_karyawan)->first();
        $dataKontrak = KontrakKaryawan::where('id_karyawan', operator: $dataPribadi->id_karyawan)->where('status_kontrak', '1')->first();

        $dataPendidikan = RiwayatPendidikan::where('id_karyawan', operator: $dataPribadi->id_karyawan)->where('deleted_at', null)->orderBy('tahun_lulus', 'desc')->get();

        return view('admin.karyawan.detail-karyawan', [
            'MasterAgama' => $MasterAgama,
            'MasterProvinsi' => $dataProvinsi,
            'dataPribadi' => $dataPribadi,
            'dataAlamat' => $dataAlamat,
            'dataKontak' => $dataKontak,
            'dataPendidikan' => $dataPendidikan,
            'dataKepegawaian' => $dataKepegawaian,
            'dataPenggajian' => $dataPenggajian,
            'dataKontrak' => $dataKontrak,
        ]);
    }

    public function updateKaryawan($id)
    {
        $MasterAgama = MasterAgama::all();
        $dataPribadi = Karyawan::select(
            'karyawan.id_karyawan',
            'karyawan.nama_lengkap',
            'k.nik_karyawan',
            'karyawan.jenis_kelamin',
            'karyawan.no_hp',
            'karyawan.tempat_lahir',
            'karyawan.tanggal_lahir',
            'karyawan.id_agama',
            'agama.agama',
            'mj.jabatan',
            'msk.status_karyawan',
            'karyawan.status_aktif',
            'karyawan.no_ktp',
            'karyawan.email_pribadi',
            'karyawan.status_nikah',
            'karyawan.kewarganegaraan',
            'karyawan.golongan_darah',
            'karyawan.tinggi_badan',
            'karyawan.berat_badan',
        )->join('kepegawaian as k', 'k.id_karyawan', '=', 'karyawan.id_karyawan')
            ->join('master_agama as agama', 'agama.id_agama', '=', 'karyawan.id_agama')
            ->join('master_status_karyawan as msk', 'k.id_status_karyawan', '=', 'msk.id_status_karyawan')
            ->join('master_jabatan as mj', 'k.id_jabatan', '=', 'mj.id_jabatan')
            ->where('karyawan.id_karyawan', $id)->first();

        $dataProvinsi = MasterProvinsi::all();
        $dataAlamat = Alamat::select(
            'alamat.*',
            'kel.nama_kelurahan',
            'kec.nama_kecamatan',
            'kota.nama_kota',
            'prov.nama_provinsi'
        )->join('master_kelurahan as kel', 'kel.id_kelurahan', '=', 'alamat.id_kelurahan')
            ->join('master_kecamatan as kec', 'kec.id_kecamatan', '=', 'kel.id_kecamatan')
            ->join('master_kota as kota', 'kota.id_kota', '=', 'kec.id_kota')
            ->join('master_provinsi as prov', 'prov.id_provinsi', '=', 'kota.id_provinsi')
            ->where('alamat.id_karyawan', operator: $dataPribadi->id_karyawan)->first();

        $dataKontak = KontakDarurat::where('id_karyawan', operator: $dataPribadi->id_karyawan)->first();
        $dataPendidikan = RiwayatPendidikan::where('id_karyawan', operator: $dataPribadi->id_karyawan)->get();
        $dataKepegawaian = Kepegawaian::select(
            'kepegawaian.nik_karyawan',
            'kepegawaian.email_kantor',
            'msk.status_karyawan',
            'msk.id_status_karyawan',
            'ms.nama_section',
            'ms.id_section',
            'mj.id_jabatan',
            'md.nama_departemen',
            'div.nama_divisi',
            'mj.jabatan',
            'k.nama_lengkap',
            'kepegawaian.alasan_keluar',
        )->join('master_status_karyawan as msk', 'msk.id_status_karyawan', '=', 'kepegawaian.id_status_karyawan')
            ->join('master_jabatan as mj', 'mj.id_jabatan', '=', 'kepegawaian.id_jabatan')
            ->join('master_section as ms', 'ms.id_section', '=', 'kepegawaian.id_section')
            ->join('master_departemen as md', 'md.id_departemen', '=', 'ms.id_departemen')
            ->join('master_divisi as div', 'div.id_divisi', '=', 'md.id_divisi')
            ->join('karyawan as k', 'k.id_karyawan', '=', 'kepegawaian.atasan_langsung')
            ->where('kepegawaian.id_karyawan', operator: $id)->first();

        $dataPenggajian = Penggajian::where('id_karyawan', operator: $dataPribadi->id_karyawan)->first();
        $dataKontrak = KontrakKaryawan::where('id_karyawan', operator: $dataPribadi->id_karyawan)->where('status_kontrak', '1')->first();

        $dataPendidikan = RiwayatPendidikan::where('id_karyawan', operator: $dataPribadi->id_karyawan)->where('deleted_at', null)->orderBy('tahun_lulus', 'desc')->get();
        $dataKaryawan = Karyawan::select(
            'karyawan.id_karyawan',
            'karyawan.nama_lengkap',
            'k.nik_karyawan',
            'karyawan.no_hp',
            'karyawan.tempat_lahir',
            'karyawan.tanggal_lahir',
            'msk.status_karyawan',
            'mj.jabatan',
            'al.alamat',
            'mk.id_kelurahan',
            'mk.nama_kelurahan',
            'kec.id_kecamatan',
            'kec.nama_kecamatan',
            'kota.id_kota',
            'kota.nama_kota',
            'prov.nama_provinsi',
            'prov.id_provinsi'
        )->join('kepegawaian as k', 'k.id_karyawan', '=', 'karyawan.id_karyawan')
            ->join('master_status_karyawan as msk', 'k.id_status_karyawan', '=', 'msk.id_status_karyawan')
            ->join('master_jabatan as mj', 'k.id_jabatan', '=', 'mj.id_jabatan')
            ->join('alamat as al', 'al.id_karyawan', '=', 'k.id_karyawan')
            ->join('master_kelurahan as mk', 'mk.id_kelurahan', '=', 'al.id_kelurahan')
            ->join('master_kecamatan as kec', 'kec.id_kecamatan', '=', 'mk.id_kecamatan')
            ->join('master_kota as kota', 'kota.id_kota', '=', 'kec.id_kota')
            ->join('master_provinsi as prov', 'prov.id_provinsi', '=', 'kota.id_provinsi')
            ->where('karyawan.id_karyawan', $id)->first();

        $dataPendidikan = RiwayatPendidikan::where('id_karyawan', $id)->where('deleted_at', null)->get();
        $MasterSection = MasterSection::where('deleted_at', null)->get();
        $MasterStatus = MasterStatusKaryawan::where('deleted_at', null)->get();
        $MasterJabatan = MasterJabatan::where('deleted_at', null)->get();

        return view('admin.karyawan.update-karyawan', [
            'dataKaryawan' => $dataKaryawan,
            'MasterAgama' => $MasterAgama,
            'MasterProvinsi' => $dataProvinsi,
            'dataPribadi' => $dataPribadi,
            'dataAlamat' => $dataAlamat,
            'dataKontak' => $dataKontak,
            'dataPendidikan' => $dataPendidikan,
            'dataKepegawaian' => $dataKepegawaian,
            'dataPenggajian' => $dataPenggajian,
            'dataKontrak' => $dataKontrak,
            'masterStatus' => $MasterStatus,
            'masterSection' => $MasterSection,
            'masterJabatan' => $MasterJabatan
        ]);
    }

    public function updateDataKaryawan(Request $request)
    {
        $dataKaryawan = $request->only([
            'nama_karyawn',
            'no_telp',
            'tempat_lahir',
            'tanggal_lahir'
        ]);

        $dataModelEmployee = Karyawan::where('id_karyawan', $request->id_karyawan)->first();
        $dataModelEmployee->update($dataKaryawan);
        $dataModelEmployee->save();

        $dataAlamat = $request->only([
            'alamat',
            'id_kelurahan',
        ]);

        Alamat::where('id_karyawan', $request->id_karyawan)->update($dataAlamat);
        return redirect()->route('admin.karyawan.update-karyawan', ['id' => $request->id_karyawan])->with('toast_success', 'Data berhasil diubah !');
    }


    public function addPendidikan(Request $request)
    {
        try {
            $data = $request->except('_token');
            $data['id_riwayat_pendidikan'] = Str::uuid();
            RiwayatPendidikan::create($data);
            return redirect()->route('admin.karyawan.update-karyawan', ['id' => $request->id_karyawan])->with('toast_success', 'Pendidikan berhasil ditambahkan !');
        } catch (\Throwable $th) {
            return redirect()->route('admin.karyawan.update-karyawan', ['id' => $request->id_karyawan])->with('toast_error', 'Pendidikan gagal ditambahkan !');
        }
    }

    public function updatePendidikan(Request $request)
    {
        try {
            $data = $request->except('_token');
            RiwayatPendidikan::where('id_riwayat_pendidikan', $request->id_riwayat_pendidikan)->update($data);
            return redirect()->route('admin.karyawan.update-karyawan', ['id' => $request->id_karyawan])->with('toast_success', 'Pendidikan berhasil diubah !');
        } catch (\Throwable $th) {
            return redirect()->route('admin.karyawan.update-karyawan', ['id' => $request->id_karyawan])->with('toast_error', 'Pendidikan gagal diubah !');
        }
    }

    public function deletePendidikan($id)
    {
        try {
            $data = RiwayatPendidikan::where('id_riwayat_pendidikan', $id)->first();
            $data->deleted_at = Carbon::now();
            $data->save();
            return redirect()->route('admin.karyawan.update-karyawan', ['id' => $data->id_karyawan])->with('toast_success', 'Pendidikan berhasil dihapus !');
        } catch (\Throwable $th) {
            return redirect()->route('admin.karyawan.update-karyawan', ['id' => $data->id_karyawan])->with('toast_error', 'Pendidikan gagal dihapus !');
        }
    }

    public function updatePenggajian(Request $request)
    {
        try {

            $data = $request->except('_token');
            $dataPenggajian = Penggajian::where('id_karyawan', $request->id_karyawan)->first();
            $dataPenggajian->update($data);
            return redirect()->route('admin.karyawan.update-karyawan', ['id' => $request->id_karyawan])->with('toast_success', 'Penggajian berhasil diubah !');
        } catch (Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function updateKepegawaian(Request $request)
    {
        try {
            $data = $request->except('_token');
            $dataKepegawaian = Kepegawaian::where('id_karyawan', $request->id_karyawan)->first();
            $dataKepegawaian->update($data);
            return redirect()->route('admin.karyawan.update-karyawan', ['id' => $request->id_karyawan])->with('toast_success', 'Kepegawaian berhasil diubah !');
        } catch (Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function updateKontakDarurat(Request $request)
    {
        try {
            $data = $request->except('_token');
            $dataKontakDarurat = KontakDarurat::where('id_karyawan', $request->id_karyawan)->first();
            $dataKontakDarurat->update($data);
            return redirect()->route('admin.karyawan.update-karyawan', ['id' => $request->id_karyawan])->with('toast_success', 'Kontak Darurat berhasil diubah !');
        } catch (Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function updateProfile(Request $request)
    {
        try {
            $data = $request->except('_token');
            $dataProfile = Karyawan::where('id_karyawan', $request->id_karyawan)->first();
            $dataProfile->update($data);
            return redirect()->route('admin.karyawan.update-karyawan', ['id' => $request->id_karyawan])->with('toast_success', 'Profile berhasil diubah !');
        } catch (Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}

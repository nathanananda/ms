<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Alamat;
use App\Models\History;
use App\Models\Karyawan;
use App\Models\Kepegawaian;
use App\Models\KontakDarurat;
use App\Models\KontrakKaryawan;
use App\Models\MasterAgama;
use App\Models\MasterProvinsi;
use App\Models\Notif;
use App\Models\Penggajian;
use App\Models\RiwayatPendidikan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserProfileController extends Controller
{
    public function index()
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
            'karyawan.created_at'
        )->join('kepegawaian as k', 'k.id_karyawan', '=', 'karyawan.id_karyawan')
            ->join('master_agama as agama', 'agama.id_agama', '=', 'karyawan.id_agama')
            ->join('master_status_karyawan as msk', 'k.id_status_karyawan', '=', 'msk.id_status_karyawan')
            ->join('master_jabatan as mj', 'k.id_jabatan', '=', 'mj.id_jabatan')
            ->where('karyawan.email_pribadi', Auth::user()->email)->first();

        $dataProvinsi = MasterProvinsi::all();
        $dataAlamat = Alamat::select(
            'alamat.*',
            'kel.nama_kelurahan',
            'kel.id_kelurahan',
            'kec.nama_kecamatan',
            'kec.id_kecamatan',
            'kota.nama_kota',
            'kota.id_kota',
            'prov.nama_provinsi',
            'prov.id_provinsi'
        )->join('master_kelurahan as kel', 'kel.id_kelurahan', '=', 'alamat.id_kelurahan')
            ->join('master_kecamatan as kec', 'kec.id_kecamatan', '=', 'kel.id_kecamatan')
            ->join('master_kota as kota', 'kota.id_kota', '=', 'kec.id_kota')
            ->join('master_provinsi as prov', 'prov.id_provinsi', '=', 'kota.id_provinsi')
            ->where('alamat.id_karyawan', operator: $dataPribadi->id_karyawan);

        $dataKontak = KontakDarurat::where('id_karyawan', operator: $dataPribadi->id_karyawan)->where('deleted_at', null)->get();

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
            'kepegawaian.alasan_keluar'
        )->join('master_status_karyawan as msk', 'msk.id_status_karyawan', '=', 'kepegawaian.id_status_karyawan')
            ->join('master_jabatan as mj', 'mj.id_jabatan', '=', 'kepegawaian.id_jabatan')
            ->join('master_section as ms', 'ms.id_section', '=', 'kepegawaian.id_section')
            ->join('master_departemen as md', 'md.id_departemen', '=', 'ms.id_departemen')
            ->join('master_divisi as div', 'div.id_divisi', '=', 'md.id_divisi')
            ->join('karyawan as k', 'k.id_karyawan', '=', 'kepegawaian.atasan_langsung')
            ->where('k.id_karyawan', operator: $dataPribadi->id_karyawan)->first();

        $dataPenggajian = Penggajian::where('id_karyawan', operator: $dataPribadi->id_karyawan)->first();
        $dataKontrak = KontrakKaryawan::where('id_karyawan', operator: $dataPribadi->id_karyawan)->where('status_kontrak', '1')->first();

        $dataPendidikan = RiwayatPendidikan::where('id_karyawan', operator: $dataPribadi->id_karyawan)->where('deleted_at', null)->orderBy('tahun_lulus', 'desc')->get();
        return view('user.profile', [
            'MasterAgama' => $MasterAgama,
            'MasterProvinsi' => $dataProvinsi,
            'dataPribadi' => $dataPribadi,
            'dataAlamat' => $dataAlamat->get(),
            'countAlamat' => $dataAlamat->count(),
            'dataKontak' => $dataKontak,
            'dataPendidikan' => $dataPendidikan,
            'dataKepegawaian' => $dataKepegawaian,
            'dataPenggajian' => $dataPenggajian,
            'dataKontrak' => $dataKontrak,
        ]);
    }

    public function addAlamat(Request $request)
    {
        try {
            $data = $request->except('_token', 'provinsi', 'kota', 'kecamatan');
            $data['id_alamat'] = Str::uuid();
            Alamat::create($data);
            return redirect()->route('user.profile')->with('toast_success', 'Alamat berhasil ditambahkan !');
        } catch (\Throwable $th) {
            return redirect()->route('user.profile')->with('toast_error', 'Alamat gagal ditambahkan !');
        }
    }


    public function addPendidikan(Request $request)
    {
        try {
            $data = $request->except('_token');
            $data['id_riwayat_pendidikan'] = Str::uuid();
            RiwayatPendidikan::create($data);
            return redirect()->route('user.profile')->with('toast_success', 'Pendidikan berhasil ditambahkan !');
        } catch (\Throwable $th) {
            return redirect()->route('user.profile')->with('toast_error', 'Pendidikan gagal ditambahkan !');
        }
    }

    public function updateAlamat(Request $request)
    {
        try {
            $data = $request->except('_token', 'provinsi', 'kota', 'kecamatan');
            $dataAlamat = Alamat::where('id_alamat', $request->id_alamat)->first();
            $dataAlamat->update($data);
            return redirect()->route('user.profile')->with('toast_success', 'Alamat berhasil diubah !');
        } catch ( \Throwable $th) {
            return redirect()->route('user.profile')->with('toast_error', 'Alamat gagal diubah : ' . $th->getMessage());
        }
    }

    public function updatePendidikan(Request $request)
    {
        try {
            $data = $request->except('_token');
            RiwayatPendidikan::where('id_riwayat_pendidikan', $request->id_riwayat_pendidikan)->update($data);
            return redirect()->route('user.profile')->with('toast_success', 'Pendidikan berhasil diubah !');
        } catch (\Throwable $th) {
            return redirect()->route('user.profile')->with('toast_error', 'Pendidikan gagal diubah !');
        }
    }

    public function deletePendidikan($id)
    {
        try {
            $data = RiwayatPendidikan::where('id_riwayat_pendidikan', $id)->first();
            $data->deleted_at = Carbon::now();
            $data->save();
            return redirect()->route('user.profile')->with('toast_success', 'Pendidikan berhasil dihapus !');
        } catch (\Throwable $th) {
            return redirect()->route('user.profile')->with('toast_error', 'Pendidikan gagal dihapus !');
        }
    }

    public function updatePenggajian(Request $request)
    {
        try {
            $dataLama = Penggajian::where('id_karyawan', $request->id_karyawan)->first();

            if (!$dataLama) {
                return back()->with('error', 'Data penggajian tidak ditemukan.');
            }

            $fieldsToCheck = [
                'no_rekening',
                'no_bpjs_kesehatan',
                'no_bpjs_ketenagakerjaan',
                'no_bpjs_pensiun',
            ];

            $perubahanAda = false;

            DB::beginTransaction();

            foreach ($fieldsToCheck as $field) {
                $valueBaru = $request->$field;
                $valueLama = $dataLama->$field;

                // Cek perbedaan
                if ($valueBaru != $valueLama) {
                    $perubahanAda = true;

                    // Untuk Admin
                    $dataAdmin = User::select(
                        'karyawan.id_karyawan'
                    )->join('karyawan', 'karyawan.email_pribadi', '=', 'users.email')
                        ->where('users.role', 'admin')->get();

                    $dataKaryawan = Karyawan::find($request->id_karyawan);

                    foreach ($dataAdmin as $admin) {
                        Notif::create([
                            'id_notif' => Str::uuid(),
                            'notif_owner' => $admin->id_karyawan,
                            'message' => $dataKaryawan->nama_lengkap . ' mengajukan perubahan data penggajian',
                            'is_read' => 0,
                            'type' => 1,
                        ]);
                    }

                    Notif::create([
                        'id_notif' => Str::uuid(),
                        'notif_owner' => $request->id_karyawan,
                        'message' => 'Anda telah mengajukan perubahan data penggajian',
                        'is_read' => 0,
                        'type' => 1,
                    ]);

                    History::create([
                        'id_history' => Str::uuid(),
                        'id_karyawan' => $request->id_karyawan,
                        'field' => $field,
                        'value_lama' => $valueLama,
                        'value_baru' => $valueBaru,
                        'approval' => 0, // pending approval
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }

            if (!$perubahanAda) {
                DB::rollBack();
                return back()->with('error', 'Tidak ada perubahan data yang diajukan.');
            }

            DB::commit();
            return back()->with('success', 'Perubahan berhasil diajukan untuk approval.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function storeKontakDarurat(Request $request)
    {
        try {
            $data = $request->except('_token');
            $data['id_kontak_darurat'] = Str::uuid();
            KontakDarurat::create($data);
            return back()->with('toast_success', 'Kontak darurat berhasil ditambahkan !');
        } catch (\Throwable $th) {
            return back()->with('toast_error', 'Kontak darurat gagal ditambahkan ! : ' . $th->getMessage());
        }
    }

    public function updateKontakDarurat(Request $request)
    {
        try {
            $kontak = KontakDarurat::where('id_kontak_darurat', $request->id_kontak_darurat)->first();

            if (!$kontak) {
                return back()->with('toast_error', 'Data kontak darurat tidak ditemukan.');
            }

            $kontak->update($request->except('_token'));
            return back()->with('toast_success', 'Kontak Darurat Berhasil Diperbaharui !');
        } catch (\Exception $e) {
            return back()->with('toast_error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function deleteKontakDarurat($id)
    {
        try {
            $kontak = KontakDarurat::where('id_kontak_darurat', $id)->first();

            if (!$kontak) {
                return back()->with('toast_error', 'Data kontak darurat tidak ditemukan.');
            }
            $kontak->deleted_at = now();
            $kontak->save();
            return back()->with('toast_success', 'Kontak Darurat Berhasil Dihapus !');
        } catch (\Exception $e) {
            return back()->with('toast_error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function updateProfile(Request $request)
    {
        try {
            $data = Karyawan::select(
                'karyawan.no_hp',
                'karyawan.id_agama as agama',
                'karyawan.status_nikah',
                'master_agama.agama as id_agama'
            )->where('id_karyawan', $request->id_karyawan)->join('master_agama', 'master_agama.id_agama', '=', 'karyawan.id_agama')->first();

            if (!$data) {
                return back()->with('toast_error', 'Data pribadi tidak ditemukan.');
            }

            // Kolom yang langsung di-update tanpa approval
            $autoUpdateFields = ['email_pribadi', 'tinggi_badan', 'berat_badan', 'gol_darah'];

            // Kolom yang harus dicek untuk approval
            $fieldsToCheck = ['no_hp', 'id_agama', 'status_nikah'];

            $perubahanAda = false;

            DB::beginTransaction();

            // Auto-update fields
            foreach ($autoUpdateFields as $field) {
                if ($request->has($field)) {
                    $data->$field = $request->$field;
                }
            }

            $data->save();

            // Approval fields
            foreach ($fieldsToCheck as $field) {
                $valueBaru = $request->$field;
                $valueLama = $data->$field;

                if ($valueLama === null || $valueBaru != $valueLama) {
                    $perubahanAda = true;

                    // Untuk Admin
                    $dataAdmin = User::select(
                        'karyawan.id_karyawan'
                    )->join('karyawan', 'karyawan.email_pribadi', '=', 'users.email')
                        ->where('users.role', 'admin')->get();

                    $dataKaryawan = Karyawan::find($request->id_karyawan);

                    foreach ($dataAdmin as $admin) {
                        Notif::create([
                            'id_notif' => Str::uuid(),
                            'notif_owner' => $admin->id_karyawan,
                            'message' => $dataKaryawan->nama_lengkap . ' mengajukan perubahan data pribadi',
                            'is_read' => 0,
                            'type' => 1,
                        ]);
                    }

                    Notif::create([
                        'id_notif' => Str::uuid(),
                        'notif_owner' => $request->id_karyawan,
                        'message' => 'Anda telah mengajukan perubahan data pribadi',
                        'is_read' => 0,
                        'type' => 1,
                    ]);

                    History::create([
                        'id_history' => Str::uuid(),
                        'id_karyawan' => $request->id_karyawan,
                        'field' => $field,
                        'value_lama' => $valueLama,
                        'value_baru' => $valueBaru,
                        'approval' => 0,
                        'data_table' => 'karyawan',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }

            if (!$perubahanAda) {
                DB::commit(); // tetap commit karena ada update langsung
                return back()->with('toast_success', 'Data pribadi berhasil diperbarui tanpa pengajuan perubahan.');
            }

            DB::commit();
            return back()->with('toast_success', 'Beberapa perubahan data pribadi berhasil diajukan untuk approval.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('toast_error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}

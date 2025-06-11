<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminKaryawanController;
use App\Http\Controllers\Admin\AdminLaporanController;
use App\Http\Controllers\Admin\AdminNotifController;
use App\Http\Controllers\Admin\AdminOffboardingController;
use App\Http\Controllers\Admin\AdminOnboardingController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\AlamatController;
use App\Http\Controllers\AllLoginController;
use App\Http\Controllers\Kepsek\KepsekDashboardController;
use App\Http\Controllers\Kepsek\KepsekKaryawanController;
use App\Http\Controllers\Kepsek\KepsekLaporanController;
use App\Http\Controllers\Kepsek\KepsekNotifController;
use App\Http\Controllers\Kepsek\KepsekOffboardingController;
use App\Http\Controllers\Kepsek\KepsekProfileController;
use App\Http\Controllers\StrukturController;
use App\Http\Controllers\User\UserFinansialController;
use App\Http\Controllers\User\UserNotificationController;
use App\Http\Controllers\User\UserProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('login', [AllLoginController::class, 'index'])->name('login');
Route::post('login', [AllLoginController::class, 'login'])->name('auth');
Route::get('change-password', [AllLoginController::class, 'changePass'])->name('change-password');
Route::post('change-password/store', [AllLoginController::class, 'storeChangePass'])->name('change-password.store');
Route::get('logout', [AllLoginController::class, 'logout'])->name('logout');


Route::middleware(['auth', 'isChangePass'])->group(function () {
    Route::get('/', function () {
        return redirect()->route('user.profile');
    });

    Route::prefix('user')->middleware(['isUser'])->group(function () {
        Route::prefix('profile')->group(function () {
            Route::get('/', [UserProfileController::class, 'index'])->name('user.profile');

            Route::prefix('pendidikan')->group(function () {
                Route::post('add', [UserProfileController::class, 'addPendidikan'])->name('user.profile.add-pendidikan');
                Route::post('update', [UserProfileController::class, 'updatePendidikan'])->name('user.profile.update-pendidikan');
                Route::get('delete/{id}', [UserProfileController::class, 'deletePendidikan'])->name('user.profile.delete-pendidikan');
            });

            Route::prefix('alamat')->group(function () {
                Route::post('add', [UserProfileController::class, 'addAlamat'])->name('user.profile.add-alamat');
                Route::post('update', [UserProfileController::class, 'updateAlamat'])->name('user.profile.update-alamat');
            });

            Route::prefix('kondar')->group(function () {
                Route::post('updateKontak', [UserProfileController::class, 'updateKontakDarurat'])->name('user.profile.updateKontak');
                Route::post('store', [UserProfileController::class, 'storeKontakDarurat'])->name('user.profile.store.kondar');
                Route::get('delete/{id}', [UserProfileController::class, 'deleteKontakDarurat'])->name('user.profile.delete.kondar');
            });







            Route::post('updatePenggajian', [UserProfileController::class, 'updatePenggajian'])->name('user.profile.updatePenggajian');
            Route::post('updateProfile', [UserProfileController::class, 'updateProfile'])->name('user.profile.updateProfile');
            Route::get('update', [UserProfileController::class, 'Update'])->name('user.profile.update');
        });

        Route::prefix('finansial')->group(function () {
            Route::get('/', [UserFinansialController::class, 'index'])->name('user.finansial');
        });

        Route::prefix('notification')->group(function () {
            Route::get('/', [UserNotificationController::class, 'index'])->name('user.notification');
            Route::post('/read/{id}', [UserNotificationController::class, 'updateRead'])->name('user.notification.read');
        });
    });


    Route::prefix('kepsek')->middleware(['isKepsek'])->group(function () {
        Route::get('/', [KepsekDashboardController::class, 'index'])->name('kepsek.dashboard');
        Route::get('getGender', [KepsekDashboardController::class, 'getGender'])->name('kepsek.getGender');
        Route::get('getReligion', [KepsekDashboardController::class, 'getReligion'])->name('kepsek.getReligion');
        Route::get('/notification', [KepsekNotifController::class, 'index'])->name('kepsek.notification');
        Route::post('notification/read/{id}', [KepsekNotifController::class, 'updateRead'])->name('kepsek.notification.read');

        Route::prefix('profile')->group(function () {
            Route::get('/', [KepsekProfileController::class, 'profile'])->name('kepsek.profile');
            Route::prefix('pendidikan')->group(function () {
                Route::post('add', [KepsekProfileController::class, 'addPendidikan'])->name('kepsek.profile.add-pendidikan');
                Route::post('update', [KepsekProfileController::class, 'updatePendidikan'])->name('kepsek.profile.update-pendidikan');
                Route::get('delete/{id}', [KepsekProfileController::class, 'deletePendidikan'])->name('kepsek.profile.delete-pendidikan');
            });

            Route::prefix('alamat')->group(function () {
                Route::post('add', [KepsekProfileController::class, 'addAlamat'])->name('kepsek.profile.add-alamat');
                Route::post('update', [KepsekProfileController::class, 'updateAlamat'])->name('kepsek.profile.update-alamat');
            });

            Route::prefix('kondar')->group(function () {
                Route::post('updateKontak', [KepsekProfileController::class, 'updateKontakDarurat'])->name('kepsek.profile.updateKontak');
                Route::post('store', [KepsekProfileController::class, 'storeKontakDarurat'])->name('kepsek.profile.store.kondar');
                Route::get('delete/{id}', [KepsekProfileController::class, 'deleteKontakDarurat'])->name('kepsek.profile.delete.kondar');
            });



            Route::post('updatePenggajian', [KepsekProfileController::class, 'updatePenggajian'])->name('kepsek.profile.updatePenggajian');
            Route::post('updateKontak', [KepsekProfileController::class, 'updateKontakDarurat'])->name('kepsek.profile.updateKontak');
            Route::post('updateProfile', [KepsekProfileController::class, 'updateProfile'])->name('kepsek.profile.updateProfile');
            Route::get('update', [KepsekProfileController::class, 'Update'])->name('kepsek.profile.update');
            Route::get('finansial', [KepsekProfileController::class, 'finansial'])->name('kepsek.finansial');
        });

        Route::prefix('karyawan')->group(function () {
            Route::get('/{status}', [KepsekKaryawanController::class, 'list'])->name('kepsek.karyawan.list');

            Route::get('detail/{id}', [KepsekKaryawanController::class, 'detailKaryawan'])->name('kepsek.karyawan.detail');
            Route::get('update/{id}', [KepsekKaryawanController::class, 'updateKaryawan'])->name('kepsek.karyawan.update-karyawan');

            Route::prefix('pendidikan')->group(function () {
                Route::post('add', [KepsekKaryawanController::class, 'addPendidikan'])->name('kepsek.detail.karyawan.add-pendidikan');
                Route::post('update', [KepsekKaryawanController::class, 'updatePendidikan'])->name('kepsek.detail.karyawan.update-pendidikan');
                Route::get('delete/{id}', [KepsekKaryawanController::class, 'deletePendidikan'])->name('kepsek.detail.karyawan.delete-pendidikan');
            });

            Route::post('updatePenggajian', [KepsekKaryawanController::class, 'updatePenggajian'])->name('kepsek.detail.karyawan.updatePenggajian');
            Route::post('updateKepegawaian', [KepsekKaryawanController::class, 'updateKepegawaian'])->name('kepsek.detail.karyawan.updateKepegawaian');
            Route::post('updateKontak', [KepsekKaryawanController::class, 'updateKontakDarurat'])->name('kepsek.detail.karyawan.updateKontak');
            Route::post('updateProfile', [KepsekKaryawanController::class, 'updateProfile'])->name('kepsek.detail.karyawan.updateProfile');

            Route::get('list/onBoarding', [KepsekKaryawanController::class, 'onBoarding'])->name('kepsek.karyawan.onboarding');
            Route::get('list/onBoarding/detail/{id}', [KepsekKaryawanController::class, 'detailOnboarding'])->name('kepsek.karyawan.detail-onboarding');

            Route::get('list/offboarding', [KepsekOffboardingController::class, 'index'])->name('kepsek.karyawan.offboarding');
            Route::post('list/offboarding/perpanjang', [KepsekOffboardingController::class, 'perpanjang'])->name('kepsek.karyawan.offboarding.perpanjang');
            Route::post('list/offboarding/pengangkatan', [KepsekOffboardingController::class, 'pengangkatan'])->name('kepsek.karyawan.offboarding.pengangkatan');
            Route::post('list/offboarding/pemberhentian', [KepsekOffboardingController::class, 'Layoff'])->name('kepsek.karyawan.offboarding.pemberhentian');

            Route::post('export', [KepsekKaryawanController::class, 'ExportExcel'])->name('kepsek.karyawan.export');
            Route::get('form/addKaryawan', [KepsekKaryawanController::class, 'addKaryawan'])->name('kepsek.karyawan.add');
        });

        Route::prefix('laporan')->group(function () {
            Route::get('kontrak/karyawan/detail/{id}', [KepsekLaporanController::class, 'dataDetail'])->name('kepsek.laporan.detail-karyawan');
            Route::get('perpanjang', [KepsekLaporanController::class, 'perpanjangIndex'])->name('kepsek.laporan.perpanjang');
            Route::post('perpanjang/store', [KepsekLaporanController::class, 'perpanjangStore'])->name('kepsek.laporan.perpanjang.store');
            Route::get('pengangkatan', [KepsekLaporanController::class, 'pengangkatanIndex'])->name('kepsek.laporan.pengangkatan');
            Route::post('pengangkatan/store', [KepsekLaporanController::class, 'pengangkatanStore'])->name('kepsek.laporan.pengangkatan.store');
            Route::get('pemberhentian', [KepsekLaporanController::class, 'pemberhentianIndex'])->name('kepsek.laporan.pemberhentian');
            Route::post('pemberhentian/store', [KepsekLaporanController::class, 'pemberhentianStore'])->name('kepsek.laporan.pemberhentian.store');

            Route::prefix('persetujuan')->group(function () {
                Route::get('/', [KepsekLaporanController::class, 'persetujuan'])->name('kepsek.laporan.persetujuan');
                Route::get('perpanjang/{id}', [KepsekLaporanController::class, 'approvalPerpanjangIndex'])->name('kepsek.laporan.persetujuan.perpanjang');
                Route::get('pengangkatan/{id}', [KepsekLaporanController::class, 'approvalPengangkatanIndex'])->name('kepsek.laporan.persetujuan.pengangkatan');
                Route::get('pemberhentian/{id}', [KepsekLaporanController::class, 'approvalPemberhentianIndex'])->name('kepsek.laporan.persetujuan.pemberhentian');
                Route::get('penambahan/{id}', [KepsekLaporanController::class, 'approvalPenambahanIndex'])->name('kepsek.laporan.persetujuan.penambahan');
                Route::get('detaill/{id}', [KepsekLaporanController::class, 'detailPersetujuan'])->name('kepsek.laporan.persetujuan.detail');

                Route::post('kontrak/reject', [KepsekLaporanController::class, 'rejectKontrak'])->name('kepsek.laporan.persetujuan.reject-kontrak');
                Route::prefix('kontrak/approve')->group(function () {
                    Route::post('perpanjang', [KepsekLaporanController::class, 'approvePerpanjang'])->name('kepsek.laporan.persetujuan.approve-kontrak');
                    Route::post('pemberhentian', [KepsekLaporanController::class, 'approvePemberhentian'])->name('kepsek.laporan.persetujuan.approve-kontrak-pemberhentian');
                    Route::post('pengangkatan', [KepsekLaporanController::class, 'approvePengangkatan'])->name('kepsek.laporan.persetujuan.approve-kontrak-pengangkatan');
                    Route::post('penambahan', [KepsekLaporanController::class, 'approvePenambahanKaryawan'])->name('kepsek.laporan.persetujuan.approve-penambahan-karyawan');
                });
            });
        });
    });



    Route::prefix('admin')->middleware(['isAdmin'])->group(function () {
        Route::get('/', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('notification', [AdminNotifController::class, 'index'])->name('admin.notification');
        Route::get('getGender', [AdminDashboardController::class, 'getGender'])->name('admin.getGender');
        Route::get('getReligion', [AdminDashboardController::class, 'getReligion'])->name('admin.getReligion');
        Route::post('/read/{id}', [AdminNotifController::class, 'updateRead'])->name('admin.notification.read');

        Route::prefix('karyawan')->group(function () {
            Route::get('/{status}', [AdminKaryawanController::class, 'list'])->name('admin.karyawan.list');
            Route::get('detail/{id}', [AdminKaryawanController::class, 'detailKaryawan'])->name('admin.karyawan.detail');
            Route::get('update/{id}', [AdminKaryawanController::class, 'updateKaryawan'])->name('admin.karyawan.update-karyawan');
            Route::get('/add/form', [AdminKaryawanController::class, 'TambahKaryawan'])->name('admin.karyawan.tambah-karyawan');
            Route::post('/add/form/store', [AdminKaryawanController::class, 'StoreKaryawan'])->name('admin.karyawan.store-karyawan');

            Route::prefix('pendidikan')->group(function () {
                Route::post('add', [AdminKaryawanController::class, 'addPendidikan'])->name('admin.detail.karyawan.add-pendidikan');
                Route::post('update', [AdminKaryawanController::class, 'updatePendidikan'])->name('admin.detail.karyawan.update-pendidikan');
                Route::get('delete/{id}', [AdminKaryawanController::class, 'deletePendidikan'])->name('admin.detail.karyawan.delete-pendidikan');
            });

            Route::post('updatePenggajian', [AdminKaryawanController::class, 'updatePenggajian'])->name('admin.detail.karyawan.updatePenggajian');
            Route::post('updateKepegawaian', [AdminKaryawanController::class, 'updateKepegawaian'])->name('admin.detail.karyawan.updateKepegawaian');
            Route::post('updateKontak', [AdminKaryawanController::class, 'updateKontakDarurat'])->name('admin.detail.karyawan.updateKontak');
            Route::post('updateProfile', [AdminKaryawanController::class, 'updateProfile'])->name('admin.detail.karyawan.updateProfile');
            Route::get('update', [AdminKaryawanController::class, 'Update'])->name('admin.detail.karyawan.update');
        });
        Route::get('onboarding', [AdminOnboardingController::class, 'onBoarding'])->name('admin.karyawan.onboarding');
        Route::get('onboarding/detail/{id}', [AdminOnboardingController::class, 'detailOnboarding'])->name('admin.karyawan.detail-onboarding');

        Route::prefix('laporan')->group(function () {
            Route::get('kontrak/karyawan/detail/{id}', [AdminLaporanController::class, 'dataDetail'])->name('admin.laporan.detail-karyawan');
            Route::get('perpanjang', [AdminLaporanController::class, 'perpanjangIndex'])->name('admin.laporan.perpanjang');
            Route::post('perpanjang/store', [AdminLaporanController::class, 'perpanjangStore'])->name('admin.laporan.perpanjang.store');
            Route::get('pengangkatan', [AdminLaporanController::class, 'pengangkatanIndex'])->name('admin.laporan.pengangkatan');
            Route::post('pengangkatan/store', [AdminLaporanController::class, 'pengangkatanStore'])->name('admin.laporan.pengangkatan.store');
            Route::get('pemberhentian', [AdminLaporanController::class, 'pemberhentianIndex'])->name('admin.laporan.pemberhentian');
            Route::post('pemberhentian/store', [AdminLaporanController::class, 'pemberhentianStore'])->name('admin.laporan.pemberhentian.store');

            Route::get('persetujuan', [AdminLaporanController::class, 'persetujuanIndex'])->name('admin.laporan.persetujuan');
            Route::get('persetujuan/approve/{id}', [AdminLaporanController::class, 'approvalPerubahanData'])->name('admin.laporan.persetujuan.approve');
            Route::get('persetujuan/reject/{id}', [AdminLaporanController::class, 'rejectPerubahanData'])->name('admin.laporan.persetujuan.reject');
        });

        Route::prefix('offboarding')->group(function () {
            Route::get('/', [AdminOffboardingController::class, 'index'])->name('admin.offboarding');
            Route::post('perpanjang', [AdminOffboardingController::class, 'Perpanjang'])->name('admin.offboarding.perpanjang');
            Route::post('perpanjang/store', [AdminOffboardingController::class, 'PerpanjangStore'])->name('admin.offboarding.perpanjang.store');
            Route::post('peangkatan', [AdminOffboardingController::class, 'Pengangkatan'])->name('admin.offboarding.pengangkatan');
            Route::post('peangkatan/store', [AdminOffboardingController::class, 'pengangkatanStore'])->name('admin.offboarding.pengangkatan.store');
            Route::post('layoff', [AdminOffboardingController::class, 'Layoff'])->name('admin.offboarding.layoff');
            Route::post('layoff/store', [AdminOffboardingController::class, 'pemberhentianStore'])->name('admin.offboarding.layoff.store');
        });

        Route::prefix('profile')->group(function () {
            Route::get('/', [AdminProfileController::class, 'profile'])->name('admin.profile');
            Route::prefix('pendidikan')->group(function () {
                Route::post('add', [AdminProfileController::class, 'addPendidikan'])->name('admin.profile.add-pendidikan');
                Route::post('update', [AdminProfileController::class, 'updatePendidikan'])->name('admin.profile.update-pendidikan');
                Route::get('delete/{id}', [AdminProfileController::class, 'deletePendidikan'])->name('admin.profile.delete-pendidikan');
            });

            Route::prefix('kondar')->group(function () {
                Route::post('updateKontak', [AdminProfileController::class, 'updateKontakDarurat'])->name('admin.profile.updateKontak');
                Route::post('store', [AdminProfileController::class, 'storeKontakDarurat'])->name('admin.profile.store.kondar');
                Route::get('delete/{id}', [AdminProfileController::class, 'deleteKontakDarurat'])->name('admin.profile.delete.kondar');
            });

            Route::prefix('alamat')->group(function () {
                Route::post('add', [AdminProfileController::class, 'addAlamat'])->name('admin.profile.add-alamat');
            });



            Route::post('updatePenggajian', [AdminProfileController::class, 'updatePenggajian'])->name('admin.profile.updatePenggajian');
            Route::post('updateKontak', [AdminProfileController::class, 'updateKontakDarurat'])->name('admin.profile.updateKontak');
            Route::post('updateProfile', [AdminProfileController::class, 'updateProfile'])->name('admin.profile.updateProfile');
            Route::get('finansial', [AdminProfileController::class, 'finansial'])->name('admin.finansial');
        });
    });

    Route::get('/get-kota/{id_provinsi}', [AlamatController::class, 'getKota']);
    Route::get('/get-kecamatan/{id_kota}', [AlamatController::class, 'getKecamatan']);
    Route::get('/get-kelurahan/{id_kecamatan}', [AlamatController::class, 'getKelurahan']);

    Route::get('/get-departemen/{divisi_id}', [StrukturController::class, 'getDepartemen']);
    Route::get('/get-section/{departemen_id}', [StrukturController::class, 'getSection']);

    Route::get('file_kontrak/{file}', function ($file) {
        $path = 'public/file_kontrak/' . $file;

        if (!Storage::exists($path)) {
            abort(404);
        }
        return Storage::download($path);
    })->name('show.file_kontrak');
});

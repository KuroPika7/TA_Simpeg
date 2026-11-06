<?php

use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\DemosiController;
use App\Http\Controllers\LamaranController;
use App\Http\Controllers\LowonganController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\PhkController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\PromosiController;
use App\Http\Controllers\PunishmentController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RewardController;
use App\Http\Controllers\PenugasanController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\SuratPeringatanController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [HomeController::class, 'welcome']);
Route::get('/joblisting', [HomeController::class, 'joblisting'])->name('jobindex');
Route::get('/tambah-lamaran', [LamaranController::class, 'create'])->name('tambah-lamaran');
Route::resource('daftar-lamaran', LamaranController::class);

Route::middleware(['auth', 'check.karyawan.status'])->group(function () {
	Route::put('/daftar-lamaran/{id}/update-status', [LamaranController::class, 'updateStatus'])->name('daftar-lamaran.update-status');
	Route::delete('/daftar-lamaran/{id}', [LamaranController::class, 'destroy'])->name('daftar-lamaran.destroy');
	Route::get('/daftar-lamaran', [LamaranController::class, 'search'])->name('daftar-lamaran.search');
	Route::get('dashboard', [HomeController::class, 'home'])->name('dashboard');

	Route::get('billing', function () {
		return view('billing');
	})->name('billing');

	Route::get('profile', [ProfileController::class, 'show'])->name('profile');

	Route::get('rtl', function () {
		return view('rtl');
	})->name('rtl');



	Route::get('daftar-cuti', [CutiController::class, 'index'])->name('daftar-cuti');
	Route::get('daftar-cuti/search', [CutiController::class, 'search'])->name('daftar-cuti.search');
	Route::put('/daftar-cuti/{id}/update-status', [CutiController::class, 'updateStatus'])->name('daftar-cuti.update-status');

	Route::get('daftar-promosi', [PromosiController::class, 'index'])->name('daftar-promosi');
	Route::get('daftar-promosi/search', [PromosiController::class, 'search'])->name('daftar-promosi.search');
	Route::put('/daftar-promosi/{id}/update-status', [PromosiController::class, 'updateStatus'])->name('daftar-promosi.update-status');

	Route::get('daftar-demosi', [DemosiController::class, 'index'])->name('daftar-demosi');
	Route::get('daftar-demosi/search', [DemosiController::class, 'search'])->name('daftar-demosi.search');
	Route::put('/daftar-demosi/{id}/update-status', [DemosiController::class, 'updateStatus'])->name('daftar-demosi.update-status');
	Route::get('daftar-reward', [RewardController::class, 'index'])->name('daftar-reward');
	Route::get('daftar-punishment', [PunishmentController::class, 'index'])->name('daftar-punishment');

	Route::get('lihat-promosi/{id}', [PromosiController::class, 'show'])->name('lihat-promosi');
	Route::get('lihat-demosi/{id}', [DemosiController::class, 'show'])->name('lihat-demosi');
	Route::get('lihat-reward/{id}', [RewardController::class, 'show'])->name('lihat-reward');
	Route::get('lihat-punishment/{id}', [PunishmentController::class, 'show'])->name('lihat-punishment');
	Route::get('lihat-phk/{id}', [PhkController::class, 'show'])->name('lihat-phk');
	Route::get('lihat-cuti/{id}', [CutiController::class, 'show'])->name('lihat-cuti');


	Route::resource('daftar-lowongan', LowonganController::class);


	Route::get('daftar-izin', function () {
		return view('izin/daftar-izin');
	})->name('daftar-izin');

	Route::get('daftar-phk', [PhkController::class, 'index'])->name('daftar-phk');
	Route::get('daftar-phk/search', [PhkController::class, 'search'])->name('daftar-phk.search');
	Route::put('/daftar-phk/{id}/update-status', [PhkController::class, 'updateStatus'])->name('daftar-phk.update-status');



	Route::get('tables', function () {
		return view('tables');
	})->name('tables');

	Route::get('virtual-reality', function () {
		return view('virtual-reality');
	})->name('virtual-reality');

	Route::get('static-sign-in', function () {
		return view('static-sign-in');
	})->name('sign-in');

	Route::get('static-sign-up', function () {
		return view('static-sign-up');
	})->name('sign-up');

	Route::get('/tambah-absen', [PresensiController::class, 'create'])->name('tambah-absen.create');
	Route::post('/tambah-absen', [PresensiController::class, 'store'])->name('tambah-absen.store');
	Route::get('/daftar-absensi', [PresensiController::class, 'index'])->name('daftar-absensi');
	Route::get('/export-absensi', [PresensiController::class, 'export'])->name('presensi.export');
	Route::get('/detail-absensi/{id}', [PresensiController::class, 'show'])->name('detail-absensi.show');

	Route::get('tambah-izin', [PresensiController::class, 'createIzin'])->name('tambah-izin');
	Route::post('/tambah-izin/storeIzin', [PresensiController::class, 'storeIzin'])->name('storeIzin');
	Route::get('/logout', [SessionsController::class, 'destroy']);
	Route::resource('daftar-karyawan', KaryawanController::class);
	Route::get('/daftar-karyawan', [KaryawanController::class, 'search'])->name('daftar-karyawan.search');
	Route::get('/tambah-karyawan', [KaryawanController::class, 'create'])->name('tambah-karyawan');
	Route::post('/tambah-karyawan', [KaryawanController::class, 'store'])->name('tambah-karyawan.store');

	Route::get('/tambah-reward', [RewardController::class, 'create'])->name('tambah-reward.create');
	Route::post('/tambah-reward', [RewardController::class, 'store'])->name('tambah-reward.store');
	Route::get('/tambah-phk', [PhkController::class, 'create'])->name('tambah-phk.create');
	Route::post('/tambah-phk', [PhkController::class, 'store'])->name('tambah-phk.store');
	Route::get('/tambah-punishment', [PunishmentController::class, 'create'])->name('tambah-punishment.create');
	Route::post('/tambah-punishment', [PunishmentController::class, 'store'])->name('tambah-punishment.store');
	Route::get('/tambah-promosi', [PromosiController::class, 'create'])->name('tambah-promosi.create');
	Route::post('/tambah-promosi', [promosiController::class, 'store'])->name('tambah-promosi.store');
	Route::get('/tambah-demosi', [demosiController::class, 'create'])->name('tambah-demosi.create');
	Route::post('/tambah-demosi', [demosiController::class, 'store'])->name('tambah-demosi.store');
	Route::get('/tambah-cuti', [CutiController::class, 'create'])->name('tambah-cuti.create');
	Route::post('/tambah-cuti', [cutiController::class, 'store'])->name('tambah-cuti.store');

	Route::resource('daftar-penugasan', PenugasanController::class);
	Route::get('/daftar-penugasan-search', [PenugasanController::class, 'search'])->name('daftar-penugasan.search');
	Route::get('/surat-peringatan-search', [SuratPeringatanController::class, 'search'])->name('surat-peringatan.search');
	Route::resource('surat-peringatan', SuratPeringatanController::class);
	Route::get('/login', function () {
		return view('dashboard');
	})->name('sign-up');
});




Route::group(['middleware' => 'guest'], function () {
	Route::get('/register', [RegisterController::class, 'create']);
	Route::post('/register', [RegisterController::class, 'store']);
	Route::get('/login', [SessionsController::class, 'create']);
	Route::post('/session', [SessionsController::class, 'store']);
	Route::get('/login/forgot-password', [ResetController::class, 'create']);
	Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
	Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
	Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');
});
Route::get('welcome', function () {
	return view('welcome');
})->name('welcome');


Route::get('/login', function () {
	return view('session/login-session');
})->name('login');

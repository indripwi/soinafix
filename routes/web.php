<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OlahragaController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\PengurusController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\PendaftarController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\UserBiodataController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Admin\SettingController;
use App\Models\Pendaftaran;
use App\Models\Pengumuman;
use App\Models\Pengurus;
use App\Models\Prestasi;
use Illuminate\Support\Facades\Auth;


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

Route::get('/', [HomeController::class, 'homepage'])->name('homepage');
Route::get('pengumuman', [HomeController::class, 'pengumuman'])->name('pengumuman');
Route::get('pengurus', [HomeController::class, 'pengurus'])->name('pengurus');
Route::get('pendaftaran', [HomeController::class, 'pendaftaran'])->name('pendaftaran');
Route::get('prestasi', [HomeController::class, 'prestasi'])->name('prestasi');
Route::get('program', [HomeController::class, 'program'])->name('program');
Route::get('tentang', [HomeController::class, 'tentang'])->name('tentang');


Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login-masuk', [AuthController::class, 'process'])->name('login.process');

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register-masuk', [AuthController::class, 'Registerprocess'])->name('register.process');

Route::get('/forgot-password', [AuthController::class, 'forgotPasswordForm'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.send-code');
Route::get('/reset-password/{token}', [AuthController::class, 'resetPasswordForm'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

Route::get('/verify-code', [AuthController::class, 'verifyForm'])->name('password.verify-form');
Route::post('/verify-code', [AuthController::class, 'verifyCode'])->name('password.verify-code');

Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

Route::get('/admin/profile', [AuthController::class, 'profile'])->name('admin.profile')->middleware('auth');
Route::put('/admin/profile/{id}', [AuthController::class, 'updateProfile'])->middleware('auth');
Route::get('/admin/profile', [AuthController::class, 'profile'])->middleware('auth');
Route::get('/admin/profil', [AuthController::class, 'profile'])->name('admin.profile');
Route::post('/admin/profil/update/{id}', [AuthController::class, 'updateProfile'])->name('admin.updateProfile');



Route::get('admin/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

Route::get('admin/upload-program', [OlahragaController::class, 'index'])->name('olahraga.index');
Route::post('admin/upload-program-store', [OlahragaController::class, 'store'])->name('olahraga.store');
Route::get('/admin/upload-program-edit/{slug}', [OlahragaController::class, 'edit'])->name('olahraga.edit');
Route::put('/admin/upload-program-update/{slug}', [OlahragaController::class, 'update'])->name('olahraga.update');
Route::delete('/admin/upload-program-hapus/{slug}', [OlahragaController::class, 'hapus'])->name('olahraga.hapus');

Route::get('admin/upload-prestasi', [PrestasiController::class, 'index'])->name('prestasi.index');
Route::post('admin/upload-prestasi-store', [PrestasiController::class, 'store'])->name('prestasi.store');
Route::get('/admin/upload-prestasi-edit/{slug}', [PrestasiController::class, 'edit'])->name('prestasi.edit');
Route::put('/admin/upload-prestasi-update/{slug}', [PrestasiController::class, 'update'])->name('prestasi.update');
Route::delete('/admin/upload-prestasi-hapus/{slug}', [PrestasiController::class, 'hapus'])->name('prestasi.hapus');

Route::get('admin/upload-pengurus', [PengurusController::class, 'index'])->name('pengurus.index');
Route::post('admin/upload-pengurus-store', [PengurusController::class, 'store'])->name('pengurus.store');
Route::get('/admin/upload-pengurus-edit/{slug}', [PengurusController::class, 'edit'])->name('pengurus.edit');
Route::put('/admin/upload-pengurus-update/{slug}', [PengurusController::class, 'update'])->name('pengurus.update');
Route::delete('/admin/upload-pengurus-hapus/{slug}', [PengurusController::class, 'hapus'])->name('pengurus.hapus');

Route::get('admin/upload-pengumuman', [PengumumanController::class, 'index'])->name('pengumuman.index');
Route::post('admin/upload-pengumuman-store', [PengumumanController::class, 'store'])->name('pengumuman.store');
Route::get('/admin/upload-pengumuman-edit/{slug}', [PengumumanController::class, 'edit'])->name('pengumuman.edit');
Route::put('/admin/upload-pengumuman-update/{slug}', [PengumumanController::class, 'update'])->name('pengumuman.update');
Route::delete('admin/upload-pengumuman-hapus/{slug}', [PengumumanController::class, 'destroy'])->name('pengumuman.hapus');
Route::get('/pengumuman/download/{id}', [PengumumanController::class, 'download'])->name('pengumuman.download');

Route::get('admin/pendaftar', [PendaftarController::class, 'index'])->name('pendaftar.index');
Route::get('/admin/pendaftar/export', [PendaftarController::class, 'export'])->name('pendaftar.export');
Route::get('/pendaftar/download', [PendaftaranController::class, 'download'])->name('pendaftar.download');
Route::delete('/admin/pendaftar-hapus/{slug}', [PendaftarController::class, 'hapus'])->name('pendaftar.hapus');
Route::get('/admin/arsip-lolos', [PendaftarController::class, 'arsipLolos'])->name('pendaftar.arsipLolos');
Route::get('/admin/pendaftar/{slug}', [PendaftarController::class, 'show'])->name('pendaftar.detail');
Route::get('/admin/arsip/export', [PendaftarController::class, 'exportLolosPdf'])->name('pendaftar.exportLolosPdf');

Route::get('/admin/profil', [UserBiodataController::class, 'profile'])->name('admin.profil');
Route::get('admin/user', [UserBiodataController::class, 'index'])->name('user.index');
Route::post('admin/user-store', [UserBiodataController::class, 'store'])->name('user.store');
Route::resource('biodata', UserBiodataController::class);
Route::get('admin/user-edit/{slug}', [UserBiodataController::class, 'edit'])->name('user.edit');
Route::get('admin/user-hapus/{slug}', [UserBiodataController::class, 'hapus'])->name('user.hapus');
Route::get('admin/user-create/', [UserBiodataController::class, 'create'])->name('user.create');
Route::put('/admin/user/{id}', [UserBiodataController::class, 'update'])->name('user.update');


Route::post('/pendaftar/{id}/status', [PendaftarController::class, 'updateStatus'])->name('pendaftar.updateStatus');

Route::resource('user', UserBiodataController::class);

Route::middleware(['auth'])->group(function () {
    Route::get('pengguna/pendaftaran', [PendaftaranController::class, 'index'])->name('pendaftaran.index');

    Route::middleware('pendaftaran.buka')->group(function () {
        Route::post('pengguna/pendaftaran', [PendaftaranController::class, 'store'])->name('pendaftaran.store');
        Route::get('/pengguna/pendaftaran-edit/{slug}', [PendaftaranController::class, 'edit'])->name('pendaftaran.edit');
        Route::put('/pengguna/pendaftaran-update/{slug}', [PendaftaranController::class, 'update'])->name('pendaftaran.update');
    });

    Route::delete('/pengguna/pendaftaran-hapus/{slug}', [PendaftaranController::class, 'hapus'])->name('pendaftaran.hapus');
    Route::get('/pendaftaran/download/{file}', [PendaftaranController::class, 'download'])->name('pendaftaran.download');
});


Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin/setting', [SettingController::class, 'index'])->name('admin.setting.index');
    Route::post('/admin/setting/update', [SettingController::class, 'update'])->name('admin.setting.update');
});

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
})->name('logout');

Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('homepage');
})->name('logout');




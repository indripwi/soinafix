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
Route::get('riwayat', [RiwayatController::class, 'riwayat'])->name('riwayat');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login-masuk', [AuthController::class, 'process'])->name('login.process');

Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);


Route::get('admin/dashboard', [DashboardController::class, 'dashboard'])->name('dashbord');
Route::get('admin/upload-program', [OlahragaController::class, 'index'])->name('olahraga.index');
Route::post('admin/upload-program-store', [OlahragaController::class, 'store'])->name('olahraga.store');
Route::get('/admin/upload-program-edit/{slug}', [OlahragaController::class, 'edit'])->name('olahraga.edit');
Route::put('/admin/upload-program-update/{slug}', [OlahragaController::class, 'update'])->name('olahraga.update');
Route::get('/admin/upload-program-hapus/{slug}', [OlahragaController::class, 'hapus'])->name('olahraga.hapus');
Route::get('admin/upload-prestasi', [PrestasiController::class, 'index'])->name('prestasi.index');
Route::post('admin/upload-prestasi-store', [PrestasiController::class, 'store'])->name('prestasi.store');
Route::get('/admin/upload-prestasi-edit/{slug}', [PrestasiController::class, 'edit'])->name('prestasi.edit');
Route::put('/admin/upload-prestasi-update/{slug}', [PrestasiController::class, 'update'])->name('prestasi.update');
Route::get('/admin/upload-prestasi-hapus/{slug}', [PrestasiController::class, 'hapus'])->name('prestasi.hapus');
Route::get('admin/upload-pengurus', [PengurusController::class, 'index'])->name('pengurus.index');
Route::post('admin/upload-pengurus-store', [PengurusController::class, 'store'])->name('pengurus.store');
Route::get('/admin/upload-pengurus-edit/{slug}', [PengurusController::class, 'edit'])->name('pengurus.edit');
Route::put('/admin/upload-pengurus-update/{slug}', [PengurusController::class, 'update'])->name('pengurus.update');
Route::get('/admin/upload-pengurus-hapus/{slug}', [PengurusController::class, 'hapus'])->name('pengurus.hapus');
Route::get('admin/upload-pengumuman', [PengumumanController::class, 'index'])->name('pengumuman.index');
Route::post('admin/upload-pengumuman-store', [PengumumanController::class, 'store'])->name('pengumuman.store');
Route::get('/admin/upload-pengumuman-edit/{slug}', [PengumumanController::class, 'edit'])->name('pengumuman.edit');
Route::put('/admin/upload-pengumuman-update/{slug}', [PengumumanController::class, 'update'])->name('pengumuman.update');
Route::get('/admin/upload-pengumuman-hapus/{slug}', [PengumumanController::class, 'hapus'])->name('pengumuman.hapus');
Route::get('/pengumuman/download/{id}', [PengumumanController::class, 'download'])->name('pengumuman.download');
Route::get('admin/pendaftar', [PendaftarController::class, 'index'])->name('pendaftar.index');
Route::get('/admin/pendaftar/export', [PendaftarController::class, 'export'])->name('pendaftar.export');
Route::get('/pendaftar/download/{file}', [PendaftarController::class, 'download'])->name('pendaftar.download');


Route::get('admin/user', [UserBiodataController::class, 'index'])->name('user.index');
Route::post('admin/user-store', [UserBiodataController::class, 'store'])->name('user.store');
Route::get('admin/user-edit/{slug}', [UserBiodataController::class, 'edit'])->name('user.edit');
Route::get('admin/user-hapus/{slug}', [UserBiodataController::class, 'hapus'])->name('user.hapus');
Route::get('admin/user-create/', [UserBiodataController::class, 'create'])->name('user.create');
Route::post('/pendaftar/{id}/status', [PendaftarController::class, 'updateStatus'])->name('pendaftar.updateStatus');

Route::resource('user', UserBiodataController::class);

Route::get('pengguna/pendaftaran', [PendaftaranController::class, 'index'])->name('pendaftaran.index');
Route::post('pengguna/pendaftaran', [PendaftaranController::class, 'store'])->name('pendaftaran.store');
Route::get('/pengguna/pendaftaran-edit/{slug}', [PendaftaranController::class, 'edit'])->name('pendaftaran.edit');
Route::put('/pengguna/pendaftaran-update/{slug}', [PendaftaranController::class, 'update'])->name('pendaftaran.update');
Route::delete('/pengguna/pendaftaran-hapus/{slug}', [PendaftaranController::class, 'hapus'])->name('pendaftaran.hapus');
Route::get('/pendaftaran/download/{file}', [PendaftaranController::class, 'download'])->name('pendaftaran.download');

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
})->name('logout');


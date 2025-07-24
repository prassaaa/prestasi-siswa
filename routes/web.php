<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\LombaController as AdminLombaController;
use App\Http\Controllers\Admin\NotifikasiController as AdminNotifikasiController;
use App\Http\Controllers\Admin\PrestasiController as AdminPrestasiController;
use App\Http\Controllers\Admin\SekolahController as AdminSekolahController;
use App\Http\Controllers\Admin\SiswaController as AdminSiswaController;
use App\Http\Controllers\Auth\RegisterSiswaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Siswa\DashboardController as SiswaDashboardController;
use App\Http\Controllers\Siswa\LombaController as SiswaLombaController;
use App\Http\Controllers\Siswa\NotifikasiController as SiswaNotifikasiController;
use App\Http\Controllers\Siswa\PrestasiController as SiswaPrestasiController;
use App\Http\Controllers\Siswa\ProfilController as SiswaProfilController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Landing page
Route::get('/', [App\Http\Controllers\LandingController::class, 'index'])->name('landing');

// Halaman Informasi Lomba
Route::get('/lomba', [App\Http\Controllers\LandingController::class, 'showAllLomba'])->name('lomba.index');
Route::get('/lomba/search', [App\Http\Controllers\LandingController::class, 'showAllLomba'])->name('lomba.search');

// Halaman daftar prestasi
Route::get('/prestasi', [App\Http\Controllers\LandingController::class, 'showAllPrestasi'])->name('prestasi.index');
Route::get('/prestasi/search', [App\Http\Controllers\LandingController::class, 'showAllPrestasi'])->name('prestasi.search');

// API endpoints untuk detail modal
Route::get('/api/lomba/{id}', [App\Http\Controllers\LandingController::class, 'getLombaDetail']);
Route::get('/api/prestasi/{id}', [App\Http\Controllers\LandingController::class, 'getPrestasiDetail']);

// Custom Register untuk Siswa
Route::get('/register-siswa', [RegisterSiswaController::class, 'create'])->name('register.siswa');
Route::post('/register-siswa', [RegisterSiswaController::class, 'store'])->name('register.siswa.store');

// Redirect berdasarkan role setelah login
Route::get('/dashboard', function () {
    if (auth()->user()->role_id == 1) {
        return redirect()->route('admin.dashboard');
    } else {
        return redirect()->route('siswa.dashboard');
    }
})->middleware(['auth'])->name('dashboard');

// Routes Admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Routes CRUD Siswa
    Route::resource('/siswa', AdminSiswaController::class);
    Route::get('/admin/siswa/search', [App\Http\Controllers\Admin\SiswaController::class, 'search'])->name('admin.siswa.search');

    // Routes CRUD Sekolah
    Route::resource('/sekolah', AdminSekolahController::class);

    // Routes CRUD Lomba
    Route::resource('/lomba', AdminLombaController::class);
    Route::get('/lomba/export/pdf', [AdminLombaController::class, 'exportPDF'])->name('lomba.export.pdf');

    // Routes CRUD Prestasi
    Route::resource('/prestasi', AdminPrestasiController::class);
    Route::post('/prestasi/{id}/verify', [AdminPrestasiController::class, 'verify'])->name('prestasi.verify');
    Route::post('/prestasi/bulk-approve', [AdminPrestasiController::class, 'bulkApprove'])->name('prestasi.bulk-approve');
    Route::post('/prestasi/bulk-reject', [AdminPrestasiController::class, 'bulkReject'])->name('prestasi.bulk-reject');

    // Routes Notifikasi
    Route::get('/notifikasi', [AdminNotifikasiController::class, 'index'])->name('notifikasi.index');
    Route::get('/notifikasi/create', [AdminNotifikasiController::class, 'create'])->name('notifikasi.create');
    Route::post('/notifikasi', [AdminNotifikasiController::class, 'store'])->name('notifikasi.store');
    Route::delete('/notifikasi/{id}', [AdminNotifikasiController::class, 'destroy'])->name('notifikasi.destroy');
    Route::post('/notifikasi/send-to-all', [AdminNotifikasiController::class, 'sendToAll'])->name('notifikasi.send-to-all');
});

// Routes Siswa
Route::middleware(['auth', 'role:siswa'])->prefix('siswa')->name('siswa.')->group(function () {
    Route::get('/dashboard', [SiswaDashboardController::class, 'index'])->name('dashboard');

    // Routes Profil
    Route::get('/profil', [SiswaProfilController::class, 'index'])->name('profil.index');
    Route::get('/profil/edit', [SiswaProfilController::class, 'edit'])->name('profil.edit');
    Route::put('/profil', [SiswaProfilController::class, 'update'])->name('profil.update');
    Route::get('/profil/change-password', [SiswaProfilController::class, 'changePassword'])->name('profil.change-password');
    Route::put('/profil/update-password', [SiswaProfilController::class, 'updatePassword'])->name('profil.update-password');

    // Routes Prestasi
    Route::resource('/prestasi', SiswaPrestasiController::class);
    Route::get('/prestasi/{id}/print', [App\Http\Controllers\Siswa\PrestasiController::class, 'printPDF'])->name('prestasi.print');

    // Routes Notifikasi
    Route::get('/notifikasi', [SiswaNotifikasiController::class, 'index'])->name('notifikasi.index');
    Route::get('/notifikasi/{id}', [SiswaNotifikasiController::class, 'show'])->name('notifikasi.show');
    Route::post('/notifikasi/mark-all-as-read', [SiswaNotifikasiController::class, 'markAllAsRead'])->name('notifikasi.mark-all-as-read');
    Route::delete('/notifikasi/{id}', [SiswaNotifikasiController::class, 'destroy'])->name('notifikasi.destroy');
    Route::get('/notifikasi/count/unread', [SiswaNotifikasiController::class, 'count'])->name('notifikasi.count');

    // Routes Lomba (view only)
    Route::get('/lomba', [SiswaLombaController::class, 'index'])->name('lomba.index');
    Route::get('/lomba/{id}', [SiswaLombaController::class, 'show'])->name('lomba.show');
});

// Default Profile Route dari Breeze
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

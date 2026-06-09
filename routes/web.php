<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\OrangTuaController;
use App\Http\Controllers\GuruController;

/*
|--------------------------------------------------------------------------
| PUBLIC
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| REDIRECT ROLE
|--------------------------------------------------------------------------
*/
Route::get('/redirect-role', function () {

    if (!auth()->check()) {
        return redirect('/login');
    }

    return match (auth()->user()->role) {
        'admin' => redirect()->route('admin.dashboard'),
        'guru' => redirect()->route('guru.dashboard'),
        'orang_tua' => redirect()->route('orangtua.dashboard'),
        default => redirect('/'),
    };

})->name('redirect.role');

/*
|--------------------------------------------------------------------------
| AUTH USER
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', fn() => redirect()->route('redirect.role'))
        ->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    /*
    |--------------------------------------------------------------------------
    | ORANG TUA
    |--------------------------------------------------------------------------
    */
    Route::prefix('orangtua')->group(function () {

        Route::get('/dashboard', [OrangTuaController::class, 'dashboard'])
            ->name('orangtua.dashboard');

        Route::get('/beranda', [OrangTuaController::class, 'beranda'])
            ->name('orangtua.beranda');

        Route::get('/riwayat', [OrangTuaController::class, 'riwayat'])
            ->name('orangtua.riwayat');
    });

    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */
    Route::post('/logout', function () {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/login');
    })->name('logout');
});

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('admin')->group(function () {

    Route::get('/', [AdminController::class, 'index'])
        ->name('admin.dashboard');

    // ✅ CRUD
    Route::resource('siswa', SiswaController::class);
    Route::resource('guru', GuruController::class);
    Route::resource('orangtua', OrangTuaController::class);

    // ✅ DASHBOARD STATS
    Route::get('/dashboard-stats', [AdminController::class, 'dashboardStats'])
        ->name('admin.dashboard.stats');

    // ✅ KALENDER
    Route::get('/kalender-tahun', [AdminController::class, 'kalenderTahunan'])
        ->name('admin.kalender.tahun');

    Route::get('/kalender/detail/{tanggal}', [AdminController::class, 'detailTanggal'])
        ->name('admin.kalender.detail');

    // ✅ LAPORAN
    Route::get('/laporan/kelas', [AbsensiController::class, 'laporanKelas'])
        ->name('admin.laporan.kelas');
});

/*
|--------------------------------------------------------------------------
| GURU
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('guru')->group(function () {

    // ✅ DASHBOARD
    Route::get('/dashboard', [GuruController::class, 'dashboard'])
        ->name('guru.dashboard');

    // ✅ DATA SISWA (FIX ERROR)
    Route::get('/siswa', function () {

        $guruId = auth()->id();

        $kelas = DB::table('kelas')
            ->where('guru_id', $guruId)
            ->first();

        $siswa = collect();

        if ($kelas) {
            $siswa = DB::table('siswa')
                ->where('kelas_id', $kelas->id)
                ->orderBy('nama')
                ->get();
        }

        return view('guru.siswa', compact('siswa', 'kelas'));

    })->name('guru.siswa');

    // ✅ ABSENSI
    Route::get('/absensi/kelas', [AbsensiController::class, 'formKelas'])
        ->name('guru.absensi.kelas');

    Route::post('/absensi/kelas', [AbsensiController::class, 'storeKelas'])
        ->name('guru.absensi.storeKelas');

    // ✅ LAPORAN
    Route::get('/laporan', fn() => view('guru.laporan'))
        ->name('guru.laporan');

    Route::get('/laporan/bulanan', [GuruController::class, 'laporanBulanan'])
        ->name('guru.laporan.bulanan');

    Route::get('/laporan/siswa', [GuruController::class, 'laporanSiswa'])
        ->name('guru.laporan.siswa');
});

/*
|--------------------------------------------------------------------------
| AUTH (Breeze / Jetstream)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
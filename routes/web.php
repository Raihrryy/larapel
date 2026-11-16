<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PetugasAuthController;
use App\Http\Controllers\PetugasController;
use App\Http\Middleware\PetugasAuth;
use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\Petugas;

// ==========================================
// 1. HALAMAN PENGUNJUNG
// ==========================================
Route::get('/', function () {
    $data_buku = class_exists(Buku::class) ? Buku::all() : collect();
    return view('welcome', compact('data_buku'));
})->name('pengunjung.index');

Route::post('/pinjam-buku', [PeminjamanController::class, 'storePengunjung'])->name('pengunjung.pinjam');

// ==========================================
// 2. AUTENTIKASI ADMIN & PETUGAS
// ==========================================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/petugas/login', [PetugasAuthController::class, 'showLogin'])->name('petugas.login');
Route::post('/petugas/login', [PetugasAuthController::class, 'login'])->name('petugas.login.process');
Route::post('/petugas/logout', [PetugasAuthController::class, 'logout'])->name('petugas.logout');

// ==========================================
// 3. PANEL PETUGAS (TERPROTEKSI LOGIN PETUGAS)
// ==========================================
Route::prefix('petugas')->name('petugas.')->middleware(PetugasAuth::class)->group(function () {
    Route::get('/', function () {
        return redirect()->route('petugas.dashboard');
    });

    Route::get('/dashboard', function () {
        $total_judul = Buku::count();
        $total_stok = Buku::sum('stok');
        $menunggu_persetujuan = Peminjaman::where('status', 'Menunggu')->count();
        $sedang_dipinjam = Peminjaman::where('status', 'Dipinjam')->count();
        $peminjaman_terbaru = Peminjaman::with('buku')->whereIn('status', ['Menunggu', 'Dipinjam'])->latest()->take(5)->get();

        return view('petugas.dashboard', compact(
            'total_judul',
            'total_stok',
            'menunggu_persetujuan',
            'sedang_dipinjam',
            'peminjaman_terbaru'
        ));
    })->name('dashboard');

    Route::resource('buku', BukuController::class);

    Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');
    Route::post('/peminjaman', [PeminjamanController::class, 'storePetugas'])->name('peminjaman.store');
    Route::patch('/peminjaman/{id}/setujui', [PeminjamanController::class, 'setujui'])->name('peminjaman.setujui');
    Route::patch('/peminjaman/{id}/kembalikan', [PeminjamanController::class, 'kembalikan'])->name('peminjaman.kembalikan');
    Route::delete('/peminjaman/{id}', [PeminjamanController::class, 'destroy'])->name('peminjaman.destroy');
});

// ==========================================
// 4. PANEL ADMIN (TERPROTEKSI LOGIN ADMIN)
// ==========================================
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });

    Route::get('/dashboard', function () {
        $total_petugas = Petugas::count();
        $petugas_bertugas = Petugas::where('status', 'Bertugas')->count();
        $petugas_libur = Petugas::where('status', 'Libur')->count();
        $total_buku = Buku::sum('stok');
        $daftar_bertugas = Petugas::where('status', 'Bertugas')->get();

        return view('admin.dashboard', compact(
            'total_petugas',
            'petugas_bertugas',
            'petugas_libur',
            'total_buku',
            'daftar_bertugas'
        ));
    })->name('dashboard');

    Route::resource('petugas', PetugasController::class);
    Route::patch('/petugas/{id}/toggle-status', [PetugasController::class, 'toggleStatus'])->name('petugas.toggle-status');
});
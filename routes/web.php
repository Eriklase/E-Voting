<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\KandidatController;
use App\Http\Controllers\VotingController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProfileController;

// Homepage
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Authentication routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// NOTE: Google OAuth login removed. Prefill/login-as handlers also removed.
// Admin routes
Route::middleware(['auth', 'is_admin'])->group(function () {
    // Dashboard
    Route::get('/dashboard/admin', [DashboardController::class, 'adminDashboard'])->name('dashboard.admin');

    // Mahasiswa management
    Route::resource('mahasiswa', MahasiswaController::class);

    // Kandidat management
    Route::resource('kandidat', KandidatController::class);

    // Laporan
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/export-csv', [LaporanController::class, 'exportCsv'])->name('laporan.export');
    Route::get('/laporan/reset', [LaporanController::class, 'resetVoting'])->name('laporan.reset');
    Route::post('/laporan/confirm-reset', [LaporanController::class, 'confirmReset'])->name('laporan.confirm-reset');
});

// Mahasiswa routes
Route::middleware(['auth', 'is_mahasiswa'])->group(function () {
    // Dashboard
    Route::get('/dashboard/mahasiswa', [DashboardController::class, 'mahasiswaDashboard'])->name('dashboard.mahasiswa');

    // Voting
    Route::get('/voting', [VotingController::class, 'index'])->name('voting.index');
    Route::post('/voting', [VotingController::class, 'store'])->name('voting.store');
    Route::get('/voting/hasil', [VotingController::class, 'hasil'])->name('voting.hasil');

    // Kandidat public detail (mahasiswa can view candidate detail)
    Route::get('/kandidat/{id}/detail', [KandidatController::class, 'show'])->name('kandidat.public.show');
});

// Public voting results
Route::get('/hasil-voting', [VotingController::class, 'hasil'])->name('voting.hasil.public');

// Profile routes (semua user yang login)
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile/info', [ProfileController::class, 'updateInfo'])->name('profile.update-info');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.update-password');
});
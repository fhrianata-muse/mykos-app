<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\KosController;
use App\Http\Controllers\Pemilik\BookingController as PemilikBooking;
use App\Http\Controllers\Pemilik\KosController as PemilikKos;
use Illuminate\Support\Facades\Route;

// Publik: katalog dan detail kos
Route::get('/', [KosController::class, 'index'])->name('home');
Route::get('/kos/{kos}', [KosController::class, 'show'])->name('kos.show');

// Tamu: login dan daftar
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Penyewa: booking saya
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/booking-saya', [BookingController::class, 'index'])->name('bookings.index');
    Route::post('/kos/{kos}/booking', [BookingController::class, 'store'])->name('bookings.store');
});

// Pemilik kos: panel pemilik
Route::middleware(['auth', 'role:pemilik'])->prefix('pemilik')->name('pemilik.')->group(function () {
    Route::get('/', [PemilikKos::class, 'dashboard'])->name('dashboard');
    Route::resource('kos', PemilikKos::class)->except(['show']);
    Route::get('/booking', [PemilikBooking::class, 'index'])->name('bookings.index');
    Route::patch('/booking/{booking}/status', [PemilikBooking::class, 'updateStatus'])->name('bookings.status');
});

// Admin: panel CRM
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminDashboard::class, 'index'])->name('dashboard');
    Route::get('/users', [AdminDashboard::class, 'users'])->name('users');
    Route::get('/kos', [AdminDashboard::class, 'kos'])->name('kos');
    Route::patch('/kos/{kos}/toggle', [AdminDashboard::class, 'toggleKos'])->name('kos.toggle');
    Route::get('/bookings', [AdminDashboard::class, 'bookings'])->name('bookings');
    Route::patch('/bookings/{booking}/status', [AdminDashboard::class, 'updateBookingStatus'])->name('bookings.status');
});

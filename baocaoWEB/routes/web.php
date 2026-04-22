<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Authentication
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

// Booking + pages cần đăng nhập
Route::middleware('role')->group(function () {
    Route::get('/booking/{matuyen}', [BookingController::class, 'index'])->name('booking');
    Route::get('/byticket/{matuyen?}', [BookingController::class, 'byticket'])->name('byticket');

    Route::get('/payment/{matuyen?}', [PaymentController::class, 'show'])->name('payment');
    Route::post('/payment/{matuyen}/confirm', [PaymentController::class, 'confirm'])->name('payment.confirm');

    Route::get('/bill', [BillController::class, 'index'])->name('bill');
});

// Admin (role = admin)
Route::prefix('admin')->name('admin.')->middleware('role:admin')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::get('/users/create', [AdminController::class, 'createUser'])->name('users.create');
    Route::post('/users', [AdminController::class, 'storeUser'])->name('users.store');
    Route::delete('/users/{id}', [AdminController::class, 'deleteUser'])->name('users.delete');

    Route::get('/buses', [AdminController::class, 'buses'])->name('buses');
    Route::get('/routes', [AdminController::class, 'routes'])->name('routes');
    Route::get('/trips', [AdminController::class, 'trips'])->name('trips');
    Route::get('/tickets', [AdminController::class, 'tickets'])->name('tickets');
    Route::get('/payments', [AdminController::class, 'payments'])->name('payments');
    Route::get('/promotions', [AdminController::class, 'promotions'])->name('promotions');
    Route::get('/reports', [AdminController::class, 'reports'])->name('reports');
    Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
});

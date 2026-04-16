<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Admin\AdminController;

Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Registration Routes
Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

// Password Reset Routes (nếu có)
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('password.request');

Route::get('/byticket', function () {
    return view('layouts.byticket');
})->name('byticket');

Route::get('/byticket', function () {
    return view('layouts/byticket');
});

// Admin Routes
Route::prefix('admin')->middleware(['admin'])->group(function () {
    // Dashboard
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // User management
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/users/create', [AdminController::class, 'createUser'])->name('admin.users.create');
    Route::post('/users/store', [AdminController::class, 'storeUser'])->name('admin.users.store');
    Route::get('/users/delete/{id}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');

    // Bus management
    Route::get('/buses', [AdminController::class, 'buses'])->name('admin.buses');

    // Route management
    Route::get('/routes', [AdminController::class, 'routes'])->name('admin.routes');

    // Trip management
    Route::get('/trips', [AdminController::class, 'trips'])->name('admin.trips');

    // Ticket management
    Route::get('/tickets', [AdminController::class, 'tickets'])->name('admin.tickets');

    // Payment management
    Route::get('/payments', [AdminController::class, 'payments'])->name('admin.payments');

    // Promotion management
    Route::get('/promotions', [AdminController::class, 'promotions'])->name('admin.promotions');

    // Reports
    Route::get('/reports', [AdminController::class, 'reports'])->name('admin.reports');

    // Settings
    Route::get('/settings', [AdminController::class, 'settings'])->name('admin.settings');
});

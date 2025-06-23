<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\AuthController;

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Routes (memerlukan login)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('products', ProductController::class);
    Route::resource('locations', LocationController::class);
    Route::resource('stocks', StockController::class);
    Route::resource('transactions', TransactionController::class);

    // API Routes for AJAX
    Route::get('/api/product-price', [TransactionController::class, 'getProductPrice'])->name('api.product-price');

    // Master Category Routes
    Route::prefix('master')->name('master.')->group(function () {
        Route::resource('categories', \App\Http\Controllers\Master\CategoryController::class);
        Route::resource('units', \App\Http\Controllers\Master\UnitController::class);
    });
});

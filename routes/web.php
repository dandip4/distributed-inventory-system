<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\TransactionController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('products', ProductController::class);
Route::resource('locations', LocationController::class);
Route::resource('stocks', StockController::class);
Route::resource('transactions', TransactionController::class);

// Master Category Routes
Route::prefix('master')->name('master.')->group(function () {
    Route::resource('categories', \App\Http\Controllers\Master\CategoryController::class);
    Route::resource('units', \App\Http\Controllers\Master\UnitController::class);
});

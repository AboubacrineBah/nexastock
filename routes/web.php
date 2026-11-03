<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockMovementController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;

Route::get('/connexion', [AuthController::class, 'show'])->name('login');
Route::post('/connexion', [AuthController::class, 'login'])->name('login.attempt');
Route::post('/deconnexion', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/', DashboardController::class)->name('dashboard');
    Route::resource('articles', ProductController::class)->except('destroy');
    Route::resource('categories', CategoryController::class)->except(['show', 'destroy']);
    Route::resource('fournisseurs', SupplierController::class)->except('destroy')->parameters(['fournisseurs' => 'fournisseur']);
    Route::get('/mouvements', [StockMovementController::class, 'index'])->name('mouvements.index');
    Route::get('/mouvements/nouveau', [StockMovementController::class, 'create'])->name('mouvements.create');
    Route::post('/mouvements', [StockMovementController::class, 'store'])->name('mouvements.store');
    Route::get('/rapports', [DashboardController::class, 'reports'])->name('rapports');
});

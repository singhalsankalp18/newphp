<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\Web\AdminController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['AdminMiddleware'])->group(function () {
    Route::get('user-management', [AdminController::class, 'userManagement'])->name('user.management');
    Route::post('user-status', [AdminController::class, 'userStatusUpdate'])->name('user.status');
    Route::get('warehouses-management', [AdminController::class, 'warehousesManagement'])->name('warehouses.management');
    Route::post('warehouses-store', [AdminController::class, 'warehousesStore'])->name('warehouses.store');
    Route::get('warehouses-settings/{id}', [AdminController::class, 'warehousesSettings'])->name('warehouses.settings');
});

require __DIR__.'/auth.php';

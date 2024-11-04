<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\UserMiddleware;
use App\Http\Controllers\Api\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('user/')->group(function () {
        Route::post('register', [UserController::class, 'Register'])->name('register');
        Route::post('login', [UserController::class, 'Login'])->name('login');
    Route::middleware(['UserMiddleware'])->group(function () {
        Route::get('profile', [UserController::class, 'Profile'])->name('profile');
    });
});

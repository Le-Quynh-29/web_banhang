<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::group(['middleware' => ['guest']], function () {
    Route::prefix('admin')->group(function () {
        Route::get('/login', [\App\Http\Controllers\Auth\AdminController::class, 'viewLogin'])->name('admin.view.login');
        Route::post('/login', [\App\Http\Controllers\Auth\AdminController::class, 'login'])->name('admin.login');
    });
});

Route::group(['middleware' => ['admin.auth']], function () {
    Route::prefix('admin')->group(function () {
        Route::get('/logout', [\App\Http\Controllers\Auth\AdminController::class, 'logout'])->name('admin.logout');
        Route::get('/', [\App\Http\Controllers\Backend\DashboardController::class, 'index'])->name('dashboard');
    });
});

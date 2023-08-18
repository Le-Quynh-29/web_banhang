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
    Route::get('/login', [\App\Http\Controllers\Auth\AdminController::class, 'viewLogin'])->name('login');
    Route::post('/login', [\App\Http\Controllers\Auth\AdminController::class, 'login'])->name('admin.login');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/logout', [\App\Http\Controllers\Auth\AdminController::class, 'logout'])->name('logout');
    Route::get('/', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('user',\App\Http\Controllers\UserController::class);
});

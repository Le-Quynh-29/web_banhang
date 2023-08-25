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
    Route::get('/login', [\App\Http\Controllers\Auth\LoginController::class, 'viewLogin'])->name('login');
    Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class, 'login'])->name('admin.login');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('content/{path}', [\App\Http\Controllers\ContentController::class, 'show'])->name('content.show');
    Route::get('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

    Route::prefix('auth')->group(function () {
        Route::get('/profile', [\App\Http\Controllers\UserController::class, 'profile'])->name('auth.profile');
        Route::get('/profile/edit', [\App\Http\Controllers\UserController::class, 'editProfile'])->name('auth.profile.edit');
    });

    Route::get('/', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::prefix('user')->group(function () {
        Route::post('/unlock-or-lock/{id}', [\App\Http\Controllers\UserController::class, 'unlockOrLock'])
            ->name('user.unlock.or.lock');
    });

    Route::resource('user',\App\Http\Controllers\UserController::class);
    Route::resource('category',\App\Http\Controllers\CategoryController::class);
    Route::prefix('log')->group(function () {
        Route::get('/', [\App\Http\Controllers\LogController::class, 'index'])->name('log.index');
        Route::get('/{id}', [\App\Http\Controllers\LogController::class, 'show'])->name('log.show');
    });

    Route::prefix('permission')->group(function () {
        Route::get('/', [\App\Http\Controllers\PermissionController::class, 'index'])->name('permission.index');
        Route::get('edit/{id}', [\App\Http\Controllers\PermissionController::class, 'edit'])->name('permission.edit');
        Route::post('edit/{id}', [\App\Http\Controllers\PermissionController::class, 'update'])->name('permission.update');
    });
});

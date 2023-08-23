<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Route::group(['middleware' => ['guest']], function () {
    Route::prefix('admin')->group(function () {
        Route::post('/check-login', [\App\Http\Controllers\Auth\AdminController::class, 'checkErrorLogin'])
            ->name('ajax.admin.check.login');
    });
//});
Route::group(['middleware' => ['auth']], function () {
    Route::prefix('user')->group(function () {
        Route::post('/unlock-or-lock', [\App\Http\Controllers\UserController::class, 'unlockOrlock'])->name('ajax.user.unlock.or.lock');
    });
});


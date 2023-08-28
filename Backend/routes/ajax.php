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

Route::prefix('admin')->group(function () {
    Route::post('/check-login', [\App\Http\Controllers\Auth\LoginController::class, 'checkErrorLogin'])
        ->name('ajax.admin.check.login');
});

Route::group(['middleware' => ['auth']], function () {
    Route::post('/validator/unique', [\App\Http\Controllers\Ajax\BaseController::class, 'validateUnique'])
        ->name('ajax.validate.unique');
    Route::get('/autocomplete', [\App\Http\Controllers\Ajax\BaseController::class, 'autocomplete'])
        ->name('ajax.autocomplete');

    Route::prefix('user')->group(function () {
        Route::post('/update', [\App\Http\Controllers\Ajax\UserController::class, 'update'])
            ->name('ajax.user.update');
    });
    Route::prefix('category')->group(function () {
        Route::post('/update', [\App\Http\Controllers\Ajax\CategoryController::class, 'update'])
            ->name('ajax.user.update');
    });
    Route::prefix('profile')->group(function () {
        Route::post('/update', [\App\Http\Controllers\Ajax\UserController::class, 'updateProfile'])
            ->name('ajax.profile.update');
        Route::post('/check-current-password', [\App\Http\Controllers\Ajax\UserController::class, 'checkValidateCurrentPassword'])
            ->name('ajax.profile.check.current.password');
        Route::post('/change-password', [\App\Http\Controllers\Ajax\UserController::class, 'changePassword'])
            ->name('ajax.profile.change.password');
    });
});


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
    Route::post('validator/unique', [\App\Http\Controllers\Ajax\BaseController::class, 'validateUnique'])
        ->name('ajax.validate.unique');
    Route::prefix('user')->group(function () {
        Route::get('/autocomplete', [\App\Http\Controllers\Ajax\UserController::class, 'autocomplete'])
            ->name('ajax.user.autocomplete');
        Route::post('/update', [\App\Http\Controllers\Ajax\UserController::class, 'update'])
            ->name('ajax.user.update');
    });
});


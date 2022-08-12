<?php

use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BabyListController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('/auth')->controller(AuthController::class)->group(function () {
    Route::post('login', 'login')->name('auth.login');
    Route::post('join', 'join')->name('auth.join');
});

Route::middleware('auth:sanctum')->group(function () {
    // # 회원 인증
    Route::prefix('auth')->controller(AuthController::class)->group(function(){
        Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])
            ->name('verification.notice');

        Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
            ->middleware(['signed', 'throttle:6,1'])
            ->name('verification.verify');

        Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
            ->middleware('throttle:6,1')
            ->name('verification.send');

        Route::post('logout', 'logout')->name('auth.logout');
        Route::delete('withdraw', 'withdraw')->name('auth.withdraw');
    });

    // # 게시판
    Route::prefix('list')->controller(BabyListController::class)->group(function () {
        Route::get('/',  'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::get('/{list}', 'show')->name('show');
        Route::patch('/{list}', 'update')->name('update');
        Route::delete('/{list}', 'destroy')->name('delete');
    });

});

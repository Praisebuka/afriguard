<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\LoginAPIController;
use App\Http\Controllers\PentestingController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;


Route::get('/v1', function () {
    return response()->json([ 'status' => 'success', 'message' => 'AfriGuard Version 1.0', 'data' => [ 'v1' => url('api/v1/'), 's' => $_SERVER['REMOTE_ADDR'], ]]);
});

Route::prefix('/v1')->group(function () {
    Route::post('login', [LoginAPIController::class, 'login'])->name('login');
    Route::post('register', [LoginAPIController::class, 'register'])->name('rgister');

    Route::post('register', [LoginAPIController::class, 'register'])->name('rgister');

    Route::group(['middleware' => ['auth:api']], function () {
        Route::post('/nmap-scan', [PentestingController::class, 'nmapScan']);
    });

    Route::get('/clear-config', function () {
        Artisan::call('config:clear');
        Artisan::call('cache:clear');
        Artisan::call('config:cache');
        return 'Config cleared and re-cached successfully.';
    });

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        # finds the user and updates the `email_verified_at` field.
        $request->fulfill();
        return response()->json([ 'message' => 'Email has been successfully verified!' ]);
    })->middleware('signed')->name('verification.verify');


    # resend the verification Link
    Route::post('/email/verification-notification', function (Request $request) {
        # send the verification email again.
        $request->user()->sendEmailVerificationNotification();

        return response()->json(['message' => 'Verification link sent again!']);
    })->middleware(['auth:api', 'throttle:6,1'])->name('verification.send');

});



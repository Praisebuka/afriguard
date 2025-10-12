<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PentestingController;
use Illuminate\Support\Facades\Route;


Route::get('/v1', function () {
    return response()->json([ 'status' => 'success', 'message' => 'AfriGuard Version 1.0', 'data' => [ 'v1' => url('api/v1/'), 's' => $_SERVER['REMOTE_ADDR'], ]]);
});

Route::prefix('/v1')->group(function () {
    Route::post('login', [LoginController::class, 'login'])->name('login');

    Route::group(['middleware' => ['auth:api']], function () {
        Route::post('/nmap-scan', [PentestingController::class, 'nmapScan']);
    });

});

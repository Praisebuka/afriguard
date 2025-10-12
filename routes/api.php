<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::post('login', [LoginController::class, 'login'])->name('login');



Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'api\v1', 'middleware' => ['auth:api']], function () {
    Route::post('setup', [InitialSetupController::class, 'setup']);
});

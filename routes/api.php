<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\LoginAPIController;
use App\Http\Controllers\PentestingController;
use App\Mail\WelcomeToAfriguard;
use App\User;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

Route::get('/v1', function () {
    return response()->json([ 'status' => 'success', 'message' => 'AfriGuard Version 1.0', 'data' => [ 'v1' => url('api/v1/'), 's' => $_SERVER['REMOTE_ADDR'], ]]);
});

Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);

Route::prefix('/v1')->group(function () {
    Route::post('login', [LoginAPIController::class, 'login'])->name('login');
    Route::post('register', [LoginAPIController::class, 'register'])->name('rgister');

    Route::post('register', [LoginAPIController::class, 'register'])->name('rgister');

    Route::group(['middleware' => ['auth:api']], function () {
        Route::post('/nmap-scan', [PentestingController::class, 'nmapScan']);
    });


    // Route::get('/clear-config', function () {
    //     Artisan::call('config:clear');
    //     Artisan::call('cache:clear');
    //     Artisan::call('config:cache');
    //     Artisan::call('view:clear');
    //     return 'Config cleared and re-cached successfully.';
    // });

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        # finds the user and updates the `email_verified_at` field
        $request->fulfill();
        return response()->json([ 'message' => 'Email has been successfully verified!' ]);
    })->middleware('signed')->name('verification.verify');
    
    Route::post('/resend-verification', function (Request $request) {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['message' => 'User not found.'], 404);
        }

        if ($user->hasVerifiedEmail()) {
            return response()->json(['message' => 'Email already verified.'], 200);
        }

        // Generate new verification URL
        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(180),
            ['id' => $user->getKey(), 'hash' => sha1($user->getEmailForVerification())]
        );

        # send email again
        Mail::to($user->email)->send(new WelcomeToAfriguard($user, $verificationUrl));

        return response()->json(['message' => 'Verification email resent!']);
    });




});



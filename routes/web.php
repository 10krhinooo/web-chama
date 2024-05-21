<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LockScreenController;


// Route::get('/', function () {
//     return view('');

// });
Route::get('/signin', [AuthController::class, 'signinpage'])->name('login');
Route::post('/signin', [AuthController::class, 'signIn']);
Route::get('/signup', [AuthController::class, 'signup'])->name('register');
Route::post('/signup', [AuthController::class, 'register']);
Route::get('/verify/{token}', [VerificationController::class, 'verify'])->name('verify');


Route::get('forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('forgot.password.form');
Route::post('forgot-password', [AuthController::class, 'sendResetCode'])->name('forgot.password');
Route::post('/password/send-reset-code', [AuthController::class, 'sendResetCode'])->name('password.send-reset-code');
Route::get('/password/reset/{token}', [AuthController::class, 'showResetPasswordForm'])->name('reset.password.form');
Route::post('/password/reset', [AuthController::class, 'resetPassword'])->name('password.reset');
// Route::get('reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('reset.password.form');
// Route::post('reset-password', [AuthController::class, 'resetPassword'])->name('reset.password');


Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
        Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
        Route::post('/profile/photo', [ProfileController::class, 'uploadPhoto'])->name('profile.photo');
        Route::post('/profile/delete', [ProfileController::class, 'deleteAccount'])->name('profile.destroy');

    });

Route::post('/logout',[UserController::class,'logout'])->name('logout');


Route::get('/lock-screen', [LockScreenController::class, 'showLockScreen'])->name('lock-screen');
Route::post('/unlock', [LockScreenController::class, 'unlock'])->name('unlock');

Route::get('/logout-confirm', function () {
    return view('logout-confirm');
})->name('logout.confirm');



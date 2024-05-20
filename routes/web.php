<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VerificationController;



// Route::get('/', function () {
//     return view('');

// });
Route::get('/signin', [AuthController::class, 'signinpage'])->name('login');
Route::post('/signin', [AuthController::class, 'signIn']);
Route::get('/signup', [AuthController::class, 'signup'])->name('register');
Route::post('/signup', [AuthController::class, 'register']);
Route::get('/verify/{token}', [VerificationController::class, 'verify'])->name('verify');

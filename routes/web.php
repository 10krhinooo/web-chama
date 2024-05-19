<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


// Route::get('/', function () {
//     return view('');

// });
Route::get('/signin', [AuthController::class, 'signinpage'])->name('login');
Route::post('/signin', [AuthController::class, 'signIn']);
Route::get('/signup', [AuthController::class, 'signup'])->name('register');
Route::post('/signup', [AuthController::class, 'register']);

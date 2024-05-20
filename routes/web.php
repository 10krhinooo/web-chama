<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;


// Route::get('/', function () {
//     return view('');

// });
Route::get('/signin', [AuthController::class, 'signinpage'])->name('login');
Route::post('/signin', [AuthController::class, 'signIn']);
Route::get('/signup', [AuthController::class, 'signup'])->name('register');
Route::post('/signup', [AuthController::class, 'register']);
Route::get('/verify/{token}', [VerificationController::class, 'verify'])->name('verify');



        Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
        Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
        Route::post('/profile/photo', [ProfileController::class, 'uploadPhoto'])->name('profile.photo');
        Route::post('/profile/delete', [ProfileController::class, 'deleteAccount'])->name('profile.destroy');
 
Route::post('/logout',[UserController::class,'logout'])->name('logout');


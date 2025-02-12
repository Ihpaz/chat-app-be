<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController\GoogleAuthController;
use App\Http\Controllers\AuthController\AuthController;


Route::post('login', [AuthController::class, 'login']);
Route::get('me', [AuthController::class, 'refresh']);
Route::post('logout', [AuthController::class, 'logout']);
Route::post('register', [AuthController::class, 'register']);

Route::post('google_login', [GoogleAuthController::class, 'handleGoogleLogin']);

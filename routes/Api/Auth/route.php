<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController\GoogleAuthController;
use App\Http\Controllers\AuthController\AuthController;
use App\Http\Controllers\AuthController\UserController;

Route::post('login', [AuthController::class, 'login']);
Route::get('me', [AuthController::class, 'refresh']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:api');
Route::post('register', [AuthController::class, 'register']);

Route::post('google_login', [GoogleAuthController::class, 'handleGoogleLogin']);
Route::resource('user', UserController::class, ['only' => ['index','update']])->middleware('auth:api');

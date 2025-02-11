<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Chat\ChatRoomsController;
use App\Http\Controllers\Chat\UserChatRoomsController;
use App\Http\Controllers\Chat\ChatRoomsHistoryController;


Route::resource('chat_rooms', ChatRoomsController::class, ['except' => ['create','edit']])->middleware('auth:api');
Route::resource('chat_rooms_history', ChatRoomsHistoryController::class, ['except' => ['create','edit','show']])->middleware('auth:api');
Route::resource('user_chat_rooms', UserChatRoomsController::class, ['only' => ['index','update','store']])->middleware('auth:api');


<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Chat\ChatRoomsController;
use App\Http\Controllers\Chat\UserChatRoomsController;
use App\Http\Controllers\Chat\ChatRoomsHistoryController;
use App\Http\Controllers\Chat\ChatRoomsInvitationsController;


Route::resource('chat_rooms', ChatRoomsController::class, ['except' => ['create','edit']])->middleware('auth:api');
Route::resource('chat_rooms_history', ChatRoomsHistoryController::class, ['except' => ['create','edit','show']])->middleware('auth:api');

Route::resource('user_chat_rooms', UserChatRoomsController::class, ['only' => ['index']])->middleware('auth:api');
Route::post('join', [UserChatRoomsController::class, 'join'])->middleware('auth:api');
Route::post('logout', [UserChatRoomsController::class, 'DashboardUser'])->middleware('auth:api');

Route::post('send', [ChatRoomsInvitationsController::class, 'send'])->middleware('auth:api');
Route::answer('logout', [ChatRoomsInvitationsController::class, 'logout'])->middleware('auth:api');

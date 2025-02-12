<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController\ChatRoomsController;
use App\Http\Controllers\ChatController\UserChatRoomsController;
use App\Http\Controllers\ChatController\ChatRoomsHistoryController;
use App\Http\Controllers\ChatController\ChatRoomsInvitationsController;


Route::resource('chat_rooms', ChatRoomsController::class, ['except' => ['create','edit']])->middleware('auth:api');
Route::resource('chat_rooms_history', ChatRoomsHistoryController::class, ['except' => ['create','edit','show']])->middleware('auth:api');

Route::resource('user_chat_rooms', UserChatRoomsController::class, ['only' => ['index']])->middleware('auth:api');
Route::post('join', [UserChatRoomsController::class, 'join'])->middleware('auth:api');
Route::post('logout', [UserChatRoomsController::class, 'DashboardUser'])->middleware('auth:api');

Route::post('send', [ChatRoomsInvitationsController::class, 'send'])->middleware('auth:api');
Route::post('answer', [ChatRoomsInvitationsController::class, 'answer'])->middleware('auth:api');

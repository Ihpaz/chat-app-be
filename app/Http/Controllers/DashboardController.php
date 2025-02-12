<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Auth\User;
use App\Models\Chat\ChatRooms;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

Class DashboardController extends Controller{
    
    public function DashboardUser(){

        //selain admin
        $data['user_registered'] = User::where('role_id', '!=', 1)->count();
        $data['user_active'] = User::whereHas('user_chat_rooms', function ($query) {
            $query->where('is_active',true);
        })->count();
        $data['chat_room_active'] = ChatRooms::count();

        return response()->json([
            'data' => $data
        ]);
    }
}

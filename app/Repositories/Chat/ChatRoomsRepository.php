<?php

namespace App\Repositories\Chat;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Auth\User;
use App\Models\Chat\ChatRooms;
use App\Models\Chat\UserChatRooms;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class ChatRoomsRepository
{
    public function saveData(Request $request)
    {
        $status = 200;
        $message = 'Success';
        try {
            DB::beginTransaction();
            $requestData = $request->all();
            $requestData['uuid'] =  Str::uuid()->toString();
            $requestData['created_by'] = Auth::guard('api')->user()->id;
            
            $ChatRooms=ChatRooms::create($requestData);
            $chat_room_id =$ChatRooms->id;

            $users_chat_rooms = array_map(function($user_id) use ($chat_room_id) {
                return [
                    'user_id' => $user_id,
                    'chat_room_id' => $chat_room_id,
                    'is_active' => false
                ];
            }, $request->user_ids);

            $my_user=[
                'user_id' => Auth::guard('api')->user()->id,
                'chat_room_id' => $chat_room_id,
                'is_active' => true
            ];
            array_push($users_chat_rooms,$my_user);

            UserChatRooms::insert($users_chat_rooms);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            $status = 500;
            $message = $th->getMessage();
        }
        return [
            'status' => $status,
            'message' => $message
        ];
    }

    public function updateData(Request $request)
    {
        $status = 200;
        $message = 'Success';
        try {
            DB::beginTransaction();
            $requestData = $request->all();
            $requestData['uuid'] =  Str::uuid()->toString();

            ChatRooms::where('uuid', $id)->update($requestData);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            $status = 500;
            $message = $th->getMessage();
        }
        return [
            'status' => $status,
            'message' => $message
        ];
    }


    public function deleteData($id)
    {
        $status = 200;
        $message = 'Success';
        try {
            DB::beginTransaction();

            $data = ChatRooms::where('uuid', $id)->first();
            if ($data) {
                $data->delete();
            } else {
                $status = 404;
                $message = 'Data not found';
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            $status = 500;
            $message = $th->getMessage();
        }
        return [
            'status' => $status,
            'message' => $message
        ];
    }

  
}

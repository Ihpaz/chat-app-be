<?php

namespace App\Repositories\Chat;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Auth\User;
use App\Models\Chat\UserChatRooms;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class UserUserChatRoomsRepository
{
    public function join(Request $request)
    {
        $status = 200;
        $message = 'Success';
        try {
            DB::beginTransaction();
            $requestData = $request->all();
            $requestData['user_id']= Auth::guard('api')->user()->id;
            $requestData['is_active'] = true;
            $requestData['uuid'] =  Str::uuid()->toString();

            UserChatRooms::create($requestData);

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

    public function logout(Request $request)
    {
        $status = 200;
        $message = 'Success';
        try {
            DB::beginTransaction();
            $requestData['is_active'] = false;
            $userId=Auth::guard('api')->user()->id;

            UserChatRooms::where('user_id', $userId)
            ->where('chat_room_id',$request->chat_room_id)
            ->update($requestData);
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

            $data = UserChatRooms::where('uuid', $id)->first();
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

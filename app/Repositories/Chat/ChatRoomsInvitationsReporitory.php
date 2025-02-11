<?php

namespace App\Repositories\Chat;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Auth\User;
use App\Models\Chat\ChatRoomsInvitations;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class ChatRoomsInvitationsRepository
{
    public function send(Request $request)
    {
        $status = 200;
        $message = 'Success';
        try {
            DB::beginTransaction();
            $requestData = $request->all();
            $requestData['sender_id']=Auth::guard('api')->user()->id;
            $requestData['uuid'] =  Str::uuid()->toString();

            $ChatRoomsInvitations=ChatRoomsInvitations::create($requestData);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            $status = 500;
            $message = $th->getMessage();
        }
        return [
            'status' => $status,
            'message' => $message,
            'uuid' =>  $ChatRoomsInvitations->uuid,
        ];
    }

    public function answer($id,Request $request)
    {
        $status = 200;
        $message = 'Success';
        try {
            DB::beginTransaction();
            $requestData = $request->all();
            $requestData['is_answered'] = $request->answer;
            
            ChatRoomsInvitations::where('uuid', $id)->update($requestData);
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

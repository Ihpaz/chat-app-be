<?php

namespace App\Repositories\Chat;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Auth\User;
use App\Models\Chat\ChatRoomsHistory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class ChatRoomsHistoryRepository
{
    public function saveData(Request $request)
    {
        $status = 200;
        $message = 'Success';
        try {
            DB::beginTransaction();
            $requestData = $request->all();
            $requestData['user_id']=Auth::guard('api')->user()->id;
            $requestData['uuid'] =  Str::uuid()->toString();

            ChatRoomsHistory::create($requestData);

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

    public function updateData($id,Request $request)
    {
        $status = 200;
        $message = 'Success';
        try {
            DB::beginTransaction();
            $requestData = $request->all();
            
            ChatRoomsHistory::where('uuid', $id)->update($requestData);
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

            $data = ChatRoomsHistory::where('uuid', $id)->first();
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

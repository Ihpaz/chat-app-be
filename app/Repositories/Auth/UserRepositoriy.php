<?php

namespace App\Repositories\Master;

use App\Models\Auth\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class UserRepository
{
    public function saveData(Request $request)
    {
        $status = 200;
        $message = 'Success';
        try {
            DB::beginTransaction();
            $requestData = $request->all();
            $requestData['uuid'] =  Str::uuid()->toString();
            $requestData['password'] = \Hash::make($request->password);
          
            $parent = Role::where('name', 'user')->first();
            $requestData['role_id'] = $parent->id;
           

            User::create($requestData);

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

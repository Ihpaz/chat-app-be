<?php

namespace App\Http\Controllers\AuthController;

use App\Http\Controllers\Controller;
use App\Models\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Resources\Auth\UserResource;

Class UserController extends Controller{

    public function index(Request $request)
    {
        $data = User::relations($request)
            ->filter($request)
            ->order($request)
            ->page($request);
        return UserResource::collection($data);
    }

}
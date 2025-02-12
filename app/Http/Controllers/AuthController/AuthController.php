<?php

namespace App\Http\Controllers\AuthController;

use App\Http\Controllers\Controller;
use App\Models\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Repositories\Auth\UserRepository;
use App\Http\Requests\Auth\ApiRegisterUserRequest;
use App\Http\Resources\Auth\UserResource;

Class AuthController extends Controller{
    protected $repo;
    public function __construct()
    {
        $this->repo = new UserRepository();
    }

    public function login(ApiLoginRequest $request)
    {

        $identityType = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $credentials = [
            $identityType => $request->email,
            'password' => $request->input('password'),
        ];
        $token = Auth::guard('api')->attempt($credentials);

        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }

        $user = Auth::guard('api')->user()->load('role');

        return response()->json([
            'status' => 'success',
            'user' =>  new UserResource($user),
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }

    public function logout(request $request)
    {
        $request->user()->tokens()->delete();
        
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }

    public function refresh()
    {
        $user = Auth::guard('api')->user()->load('role');

        return response()->json([
            'status' => 'success',
            'user' =>
            new UserResource($user),
            'authorisation' => [
                'token' => request()->bearerToken(),
                'type' => 'bearer',
            ]   
        ]);
    }

    public function register(ApiRegisterUserRequest $request){
        $response = $this->repo->saveData($request);
      
        return response()->json([
            'message' => $response['message'],
            'token' => $response['token']
        ], $response['status']);
    }
}
<?php

namespace App\Http\Controllers\AuthController;

use App\Http\Controllers\Controller;
use App\Models\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Resources\Auth\UserResource;
use App\Repositories\Auth\UserRepository;

Class UserController extends Controller{
    protected $repo;
    public function __construct()
    {
        $this->repo = new UserRepository();
    }
    public function index(Request $request)
    {
        $data = User::relations($request)
            ->filter($request)
            ->order($request)
            ->page($request);
        return UserResource::collection($data);
    }

    public function update(Request $request, $id)
    {
        $response = $this->repo->updateData($id, $request);
        return response()->json([
            'message' => $response['message']
        ], $response['status']);
    }

}
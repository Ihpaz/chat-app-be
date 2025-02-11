<?php

namespace App\Http\Controllers\AuthController;

use App\Http\Controllers\Controller;
use App\Models\Auth\User;
use App\Models\Auth\UserChatRooms;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

Class UserChatRoomsController extends Controller{

    protected $repo;
    public function __construct()
    {
        $this->repo = new UserChatRoomsReporitory();
    }

    public function index(Request $request)
    {
        $data = UserChatRooms::relations($request)
            ->filter($request)
            ->order($request)
            ->page($request);
        return UserChatRoomsResource::collection($data);
    }

    public function store(UserChatRoomsRequest $request)
    {

        $response = $this->repo->saveData($request);
        return response()->json([
            'message' => $response['message'],
        ], $response['status']);
    }

    public function update(UserChatRoomsRequest $request, $id)
    {
        $response = $this->repo->updateData($id, $request);
        return response()->json([
            'message' => $response['message']
        ], $response['status']);
    }

}
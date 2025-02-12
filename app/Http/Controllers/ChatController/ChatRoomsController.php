<?php

namespace App\Http\Controllers\ChatController;

use App\Http\Controllers\Controller;
use App\Models\Auth\User;
use App\Models\Auth\ChatRooms;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\Chat\ApiChatRoomsRequest;
use App\Repositories\Chat\ChatRoomsRepository;

Class ChatRoomsController extends Controller{

    protected $repo;
    public function __construct()
    {
        $this->repo = new ChatRoomsRepository();
    }

    public function index(Request $request)
    {
        $data = ChatRooms::relations($request)
            ->filter($request)
            ->order($request)
            ->page($request);
        return ChatRoomsResource::collection($data);
    }

    public function store(ApiChatRoomsRequest $request)
    {

        $response = $this->repo->saveData($request);
        return response()->json([
            'message' => $response['message'],
        ], $response['status']);
    }

    public function update(ApiChatRoomsRequest $request, $id)
    {
        $response = $this->repo->updateData($id, $request);
        return response()->json([
            'message' => $response['message']
        ], $response['status']);
    }

    public function show($id, Request $request)
    {
        return response()->json([
            'data' => new ChatRoomsResource(ChatRooms::relations($request)->where('uuid', $id)->firstOrFail())
        ]);
    }

    public function destroy($id)
    {
        $response = $this->repo->deleteData($id);
        return response()->json([
            'message' => $response['message']
        ], $response['status']);
    }
}
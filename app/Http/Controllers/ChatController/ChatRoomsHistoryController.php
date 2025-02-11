<?php

namespace App\Http\Controllers\AuthController;

use App\Http\Controllers\Controller;
use App\Models\Auth\User;
use App\Models\Auth\ChatRoomsHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

Class ChatRoomsHistoryController extends Controller{

    protected $repo;
    public function __construct()
    {
        $this->repo = new ChatRoomsHistoryReporitory();
    }

    public function index(Request $request)
    {
        $data = ChatRoomsHistory::relations($request)
            ->filter($request)
            ->order($request)
            ->page($request);
        return ChatRoomsHistoryResource::collection($data);
    }

    public function store(ChatRoomsHistoryRequest $request)
    {

        $response = $this->repo->saveData($request);
        return response()->json([
            'message' => $response['message'],
        ], $response['status']);
    }

    public function update(ChatRoomsHistoryRequest $request, $id)
    {
        $response = $this->repo->updateData($id, $request);
        return response()->json([
            'message' => $response['message']
        ], $response['status']);
    }

    public function destroy($id)
    {
        $response = $this->repo->deleteData($id);
        return response()->json([
            'message' => $response['message']
        ], $response['status']);
    }
}
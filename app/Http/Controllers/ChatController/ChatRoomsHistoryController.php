<?php

namespace App\Http\Controllers\ChatController;

use App\Http\Controllers\Controller;
use App\Models\Auth\User;
use App\Models\Auth\ChatRoomsHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\Chat\ApiChatRoomsHistoryRequest;
use App\Services\FcmService;
use App\Repositories\Chat\ChatRoomsHistoryRepository;

Class ChatRoomsHistoryController extends Controller{

    protected $repo;
    protected $fcm;
    public function __construct()
    {
        $this->repo = new ChatRoomsHistoryRepository();
        $this->fcm = new FcmService();
    }

    public function index(Request $request)
    {
        $data = ChatRoomsHistory::relations($request)
            ->filter($request)
            ->order($request)
            ->page($request);
        return ChatRoomsHistoryResource::collection($data);
    }

    public function store(ApiChatRoomsHistoryRequest $request)
    {

        $response = $this->repo->saveData($request);

  
        // $this->fcm->topic =$request->topic;
        // $this->fcm->title ='New Message';
        // $this->fcm->body ='New Message in Topic ='.$request->topic;
        // $this->fcm->sendToTopic();

        return response()->json([
            'message' => $response['message'],
        ], $response['status']);
    }

    public function update(ApiChatRoomsHistoryRequest $request, $id)
    {
        $response = $this->repo->updateData($id, $request);

        $this->fcm->topic =$request->topic;
        $this->fcm->title ='Update Message';
        $this->fcm->body ='Update Message in Topic ='.$request->topic;
        $this->fcm->sendToTopic();

        return response()->json([
            'message' => $response['message']
        ], $response['status']);
    }

    public function destroy($id)
    {
        $response = $this->repo->deleteData($id);

        $this->fcm->topic =$request->topic;
        $this->fcm->title ='Deleted Message';
        $this->fcm->body ='Deleted Message in Topic ='.$request->topic;
        $this->fcm->sendToTopic();

        return response()->json([
            'message' => $response['message']
        ], $response['status']);
    }
}
<?php

namespace App\Http\Controllers\ChatController;

use App\Http\Controllers\Controller;
use App\Models\Auth\User;
use App\Models\chat\ChatRoomsHistory;
use App\Models\Chat\UserChatRooms;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\Chat\ApiChatRoomsHistoryRequest;
use App\Services\FcmService;
use App\Repositories\Chat\ChatRoomsHistoryRepository;
use Illuminate\Support\Facades\Auth;

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
        try{

        
        $response = $this->repo->saveData($request);
        $fcmTokens =User::whereIn('id', function ($query) use ($request) {
                        $query->select('user_id')
                            ->from('user_chat_rooms')
                            ->where('chat_room_id', $request->chat_room_id)
                            ->where('user_id','!=', Auth::guard('api')->user()->id);
                    })->pluck('fcm_token');

     

        $this->fcm->title ='chat'.$request->name;
        $this->fcm->body ='New Message in Chat Room '.$request->name;
        return $this->fcm->sendToToken($fcmTokens);

        // return response()->json([
        //     'message' => $response['message'],
        // ], $response['status']);
        } catch (\Throwable $th) {
              return response()->json([
                'message' => $th->getMessage(),
              ], 500);
          
        }
    }

    public function update(ApiChatRoomsHistoryRequest $request, $id)
    {
        $response = $this->repo->updateData($id, $request);
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
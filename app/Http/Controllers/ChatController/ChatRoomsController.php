<?php

namespace App\Http\Controllers\ChatController;

use App\Http\Controllers\Controller;
use App\Models\Auth\User;
use App\Models\Chat\ChatRooms;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\Chat\ApiChatRoomsRequest;
use App\Repositories\Chat\ChatRoomsRepository;
use App\Http\Resources\Chat\ChatRoomsResource;
use Illuminate\Support\Facades\Auth;
use App\Services\FcmService;


Class ChatRoomsController extends Controller{

    protected $repo;
    protected $fcm;
    public function __construct()
    {
        $this->repo = new ChatRoomsRepository();
        $this->fcm = new FcmService();
    }

    public function index(Request $request)
    {
        $data = ChatRooms::relations($request)
            ->filter($request)
            ->order($request)
            ->page($request);

        return ChatRoomsResource::collection($data);
    }

    public function joinChatRooms(){
       
        $data = ChatRooms::leftJoin('user_chat_rooms', function ($join) {
            $join->on('chat_rooms.id', '=', 'user_chat_rooms.chat_room_id')
                 ->where('user_chat_rooms.user_id', Auth::id())
                 ->where('user_chat_rooms.is_active', true);
        })
        ->whereNull('user_chat_rooms.user_id') 
        ->get('chat_rooms.*');

        return ChatRoomsResource::collection($data);
    }

    public function activeChatRooms(){
       
        $data = ChatRooms::leftJoin('user_chat_rooms', function ($join) {
            $join->on('chat_rooms.id', '=', 'user_chat_rooms.chat_room_id')
                 ->where('user_chat_rooms.user_id', Auth::id())
                 ->where('user_chat_rooms.is_active', true);
        })
        ->whereNotNull('user_chat_rooms.user_id') 
        ->get('chat_rooms.*');

        return ChatRoomsResource::collection($data);
    }

    public function activeChatRoomsCount(){
       
        $data = ChatRooms::leftJoin('user_chat_rooms', function ($join) {
            $join->on('chat_rooms.id', '=', 'user_chat_rooms.chat_room_id')
                 ->where('user_chat_rooms.user_id', Auth::id())
                 ->where('user_chat_rooms.is_active', true);
        })
        ->whereNotNull('user_chat_rooms.user_id') 
        ->count();

        return response()->json([
            'message' => 'ok',
            'data' => $data
        ], 200);
    }

    public function store(ApiChatRoomsRequest $request)
    {

        $response = $this->repo->saveData($request);
        $fcmTokens =User::whereIn('id',$request->user_ids)->pluck('fcm_token');

     
        $this->fcm->title ='invitation';
        $this->fcm->body ='Please Join to Chat Room'.$request->name;
        $this->fcm->url =(string)$response['id'];
        $this->fcm->id =(string)$response['uuid'];
        $this->fcm->sendToToken($fcmTokens);
        
        return response()->json([
            'message' => $response['message'],
            'uuid' => $response['uuid']
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
        $data = ChatRooms::with(['chat_rooms_user' => function ($q) {
                    $q->with(['user']);
                }])
                ->with(['chat_user_history' => function ($q) {
                    $q->with(['user']);
                }])
                ->where('uuid', $id)->firstOrFail();

        return response()->json([
            'data' => new ChatRoomsResource($data)
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
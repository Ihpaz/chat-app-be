<?php

namespace App\Http\Controllers\ChatController;

use App\Http\Controllers\Controller;
use App\Models\Auth\User;
use App\Models\Chat\UserChatRooms;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Services\FcmService;
use App\Http\Requests\Chat\ApiUserChatRoomsRequest;
use App\Models\Chat\ChatRooms;
use App\Repositories\Chat\UserChatRoomsRepository;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Chat\UserChatRoomsResource;

Class UserChatRoomsController extends Controller{

    protected $repo;
    protected $fcm;
    public function __construct()
    {
        $this->repo = new UserChatRoomsRepository();
        $this->fcm = new FcmService();
    }

    public function index(Request $request)
    {
        $data = UserChatRooms::relations($request)
            ->filter($request)
            ->order($request)
            ->page($request);
        return UserChatRoomsResource::collection($data);
    }

    public function join(ApiUserChatRoomsRequest $request)
    {
        $response = $this->repo->join($request);
        $ChatRoom = ChatRooms::where('id',$request->chat_room_id)->first();
        $this->fcm->insertToFirestore($ChatRoom->name);

        return response()->json([
            'message' => $response['message'],
        ], $response['status']);
    }

    public function logout(ApiUserChatRoomsRequest $request)
    {
        $response = $this->repo->logout($request);

        $ChatRoom = ChatRooms::where('id',$request->chat_room_id)->first();
        $this->fcm->insertToFirestore($ChatRoom->name);

        $fcmTokens = UserChatRooms::where('chat_room_id', $request->chat_room_id)
                    ->where('user_id', '!=', Auth::id())
                    ->leftJoin('users', 'users.id', '=', 'user_chat_rooms.user_id') 
                    ->pluck('users.fcm_token');

                
        $this->fcm->title ='exit';
        $this->fcm->body =Auth::user()->nickname.' has leave Chat Room';
        $this->fcm->sendToToken($fcmTokens);

        return response()->json([
            'message' => $response['message']
        ], $response['status']);
    }

    public function accept(ApiUserChatRoomsRequest $request)
    {
        $response = $this->repo->accept($request);
        $ChatRoom = ChatRooms::where('id',$request->chat_room_id)->first();
        $this->fcm->insertToFirestore($ChatRoom->name);

        return response()->json([
            'message' => $response['message']
        ], $response['status']);
    }

    public function reject(ApiUserChatRoomsRequest $request)
    {
        $response = $this->repo->reject($request);

        $sender_id=ChatRooms::where('id',$request->chat_room_id)->pluck('created_by');
        $fcmTokens =User::whereIn('id', $sender_id)->pluck('fcm_token');
     
        $this->fcm->title ='rejected';
        $this->fcm->body ='Invitation Rejected By '.Auth::user()->name;
        $this->fcm->sendToToken($fcmTokens);

        return response()->json([
            'message' => $response['message']
        ], $response['status']);
    }

}
<?php

namespace App\Http\Controllers\ChatController;

use App\Http\Controllers\Controller;
use App\Models\Auth\User;
use App\Models\Auth\UserChatRooms;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Request\Chat\ApiGoogleLoginRequest;
use App\Services\FcmService;

Class UserChatRoomsController extends Controller{

    protected $repo;
    protected $fcm;
    public function __construct()
    {
        $this->repo = new UserChatRoomsReporitory();
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

        $this->fcm->topic =$request->topic;
        $this->fcm->title ='New user Join';
        $this->fcm->body ='New user join in Topic ='.$request->topic;
        $this->fcm->sendToTopic();

        return response()->json([
            'message' => $response['message'],
        ], $response['status']);
    }

    public function logout(ApiUserChatRoomsRequest $request, $id)
    {
        $response = $this->repo->logout($id, $request);
        
        $this->fcm->topic =$request->topic;
        $this->fcm->title ='User Logout';
        $this->fcm->body ='User Logout in Topic ='.$request->topic;
        $this->fcm->sendToTopic();

        return response()->json([
            'message' => $response['message']
        ], $response['status']);
    }

}
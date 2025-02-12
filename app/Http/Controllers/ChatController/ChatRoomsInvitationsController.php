<?php

namespace App\Http\Controllers\ChatController;

use App\Http\Controllers\Controller;
use App\Models\Auth\User;
use App\Models\Auth\ChatRoomsInvitations;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Request\Chat\ApiChatRoomsInvitationsRequest;
use App\Services\FcmService;

Class ChatRoomsInvitationsController extends Controller{

    protected $repo;
    protected $fcm;
    public function __construct()
    {
        $this->repo = new ChatRoomsInvitationsReporitory();
        $this->fcm = new FcmService();
    }

    public function send(ApiChatRoomsInvitationsRequest $request)
    {

        $response = $this->repo->send($request);
        $token = User::where('uuid', $request->target_id)->value('fcm_token');

        $this->fcm->token = $token;
        $this->fcm->title ='New Invitation';
        $this->fcm->body ='New Invitation from'.$request->user_id;
        $this->fcm->id = $response['uuid'];
        $this->fcm->sendToTopic();

        return response()->json([
            'message' => $response['message'],
        ], $response['status']);
    }

    public function answer(ApiChatRoomsAnsweredRequest $request, $id)
    {
        $response = $this->repo->answer($id, $request);
        $token = ChatRoomsInvitations::where('chat_rooms_invitations.uuid', $id)
                ->join('users', 'users.id', '=', 'chat_rooms_invitations.sender_id')
                ->value('users.fcm_token');

        $this->fcm->token = $token;
        $this->fcm->title ='Invitation Answered';
        $this->fcm->body ='Invitation Answered';
        $this->fcm->sendToTopic();

        return response()->json([
            'message' => $response['message']
        ], $response['status']);
    }

}
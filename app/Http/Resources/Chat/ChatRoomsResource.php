<?php

namespace App\Http\Resources\Chat;

use App\Http\Resources\Chat\UserChatRoomsResource;
use App\Http\Resources\Chat\ChatRoomsHistoryResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class ChatRoomsResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "uuid" => $this->uuid,
            "name" => $this->name,
            "topic" => $this->email, 
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            "user_chat_rooms" =>  UserChatRoomsResource::collection($this->whenLoaded("chat_rooms_user")),
            "chat_rooms_history" =>  ChatRoomsHistoryResource::collection($this->whenLoaded("chat_user_history")),
            "created_at" => Carbon::parse($this->created_at)->translatedFormat('d F Y'),
        ];
    }
}

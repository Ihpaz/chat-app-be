<?php

namespace App\Http\Resources\Master;

use App\Models\Chat\UserChatRoomsResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class ChatRoomsResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            "id" => $this->uuid,
            "name" => $this->name,
            "topic" => $this->email, 
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            "user_chat_rooms" => new UserChatRoomsResource($this->whenLoaded("chat_rooms_user")),
            "chat_rooms_history" => new ChatRoomsHistoryResource($this->whenLoaded("chat_rooms_history")),
            "created_at" => Carbon::parse($this->created_at)->translatedFormat('d F Y'),
        ];
    }
}

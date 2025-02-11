<?php

namespace App\Http\Resources\Chat;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;
use App\Models\Auth\UserResource;

class UserChatRoomsResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            "id" => $this->uuid,
            "user_id" => $this->user_id,
            "chat_room_id" => $this->chat_room_id, 
            "is_active" => $this->is_active,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            "user" => new UserResource($this->whenLoaded("user")),
            "created_at" => Carbon::parse($this->created_at)->translatedFormat('d F Y'),
        ];
    }
}

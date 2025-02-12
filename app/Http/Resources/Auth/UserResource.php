<?php

namespace App\Http\Resources\Auth;


use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class UserResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "email" => $this->email,
            "username" => $this->username,
            "nickname" => $this->nickname,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            "role_name" =>  $this->role_name,
            "role" => new RoleResource($this->whenLoaded("role")),
            "created_at" => Carbon::parse($this->created_at)->translatedFormat('d F Y'),
        ];
    }
}

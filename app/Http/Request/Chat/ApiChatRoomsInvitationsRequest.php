<?php

namespace App\Http\Requests\Chat;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ApiChatRoomsInvitationsRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            "target_id" => ['required'],
            "chat_rooms_id" => ['required'],
            "topic" => ['required'],
        ];
    }
}

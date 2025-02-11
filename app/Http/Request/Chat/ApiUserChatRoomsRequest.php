<?php

namespace App\Http\Requests\Chat;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ApiUserChatRoomsRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            "is_active" => ['required'],
            "user_id" => ['required'],
            "chat_rooms_id" => ['required'],
        ];
    }
}

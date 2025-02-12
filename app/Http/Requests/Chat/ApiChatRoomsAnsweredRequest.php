<?php

namespace App\Http\Requests\Chat;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ApiChatRoomsAnsweredRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            "answer" => ['required'],
            "chat_rooms_id" => ['required'],
            "topic" => ['required'],
        ];
    }
}

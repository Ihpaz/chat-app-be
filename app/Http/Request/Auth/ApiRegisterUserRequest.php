<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ApiRegisterUserRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            "name" => ['required','string'],
            "email" => ['required','email'],
            "nickname" => ['required','string'],
            "fcm_token" => ['required','string'],
        ];
    }
}

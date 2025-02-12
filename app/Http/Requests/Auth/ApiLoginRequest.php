<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ApiLoginRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
          
            "email" => [
                "required",
                "email",
            ],
            "password" => [
                $id ? 'nullable' : "required",
                "min:8", // minimal 8 karakter
                "regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/", // minimal 1 huruf kecil, 1 huruf besar, dan 1 angka
            ]
        ];
    }
}

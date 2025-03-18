<?php

namespace App\Http\Requests\Auth\Changes;

use Illuminate\Foundation\Http\FormRequest;

class ChangeUserNameRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            "user_name"=>"required|string|unique:users_users,user_name"
        ];
    }
}

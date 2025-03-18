<?php

namespace App\Http\Requests\Auth\Changes;

use Illuminate\Foundation\Http\FormRequest;

class ChangeEmailRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            "otp"=>"required|numeric",
            "email" => "required|email|exists:users_users,email",
        ];
    }
}

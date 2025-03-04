<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class VerifyEmailRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "user_code"=>"required|exists:users_users,code",
            "otp"=>"required|numeric|min_digits:6|max_digits:6|exists:users_users,otp"
        ];
    }
}

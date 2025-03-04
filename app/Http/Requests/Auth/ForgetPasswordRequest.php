<?php

namespace App\Http\Requests\Auth;
use Illuminate\Foundation\Http\FormRequest;

class ForgetPasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
      protected function prepareForValidation(): void
    {
        $this->merge([
            "otp" => rand(123652, 986412),
        ]);
    }
    public function rules(): array
    {
        return [
            'email' => 'required|exists:users_users,email',
            "otp" => "required|numeric",

        ];
    }

}

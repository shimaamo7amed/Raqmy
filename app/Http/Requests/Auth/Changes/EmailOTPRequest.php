<?php

namespace App\Http\Requests\Auth\Changes;

use Illuminate\Foundation\Http\FormRequest;

class EmailOTPRequest extends FormRequest
{
   
    public function authorize(): bool
    {
        return true;
    }
    protected function prepareForValidation(): void
    {
        $this->merge([
        'otp' => rand(123652, 986412),
        ]);
    }
    public function rules(): array
    {
        return [
            "otp" => "required|numeric",
            "email"=>"required|email|unique:users_users,email"

        ];
    }
}

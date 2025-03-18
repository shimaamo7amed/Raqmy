<?php

namespace App\Http\Requests\Auth\Changes;
use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
           'password' => 'required',
            'new_password' => 'required|string|confirmed'


        ];
    }
}

<?php

namespace App\Http\Requests\Auth\Changes;

use Illuminate\Foundation\Http\FormRequest;

class ChangePhoneRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
        "phone" => "required|string|min_digits:11|max_digits:15",
        ];
    }
}

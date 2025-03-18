<?php

namespace App\Http\Requests\Auth\Changes;

use Illuminate\Foundation\Http\FormRequest;

class ChangeNameRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
        "name" => "required|string|min:3|max:50",
        ];
    }
}

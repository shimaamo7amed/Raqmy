<?php

namespace App\Http\Requests\Auth\Changes;

use Illuminate\Foundation\Http\FormRequest;

class ChangeLocationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
        "location" => "required|string",
        "country" => "required|string",
        ];
    }
}

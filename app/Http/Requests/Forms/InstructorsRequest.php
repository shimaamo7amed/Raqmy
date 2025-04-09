<?php

namespace App\Http\Requests\Forms;

use Illuminate\Foundation\Http\FormRequest;

class InstructorsRequest extends FormRequest
{
    public function authorize(): bool
    {
      return true;
    }
    
    public function rules(): array
    {
        return [
        "name_en"=>"required|string|min:3|max:50",
        "name_ar"=>"required|string|min:3|max:50",
        "email"=>"required|email|unique:users_users,email",
        "phone"=>"required|string|min_digits:11|max_digits:15",
        // 'experince' => 'required|numeric|regex:/^\d+(\.\d{1,8})?$/',
        'experince' => 'required|string',
        "linkedIn"=>"required|string",
        "message"=>"required",
        'cv' => 'required|file|mimes:pdf,doc,docx|max:2048',

        ];
    }
}

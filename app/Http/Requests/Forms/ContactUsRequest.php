<?php

namespace App\Http\Requests\Forms;

use Illuminate\Foundation\Http\FormRequest;

class ContactUsRequest extends FormRequest
{
    public function authorize(): bool
    {
      return true;
    }
    
    public function rules(): array
    {
        return [
        "fullName"=>"required|string|min:3|max:25",
        "email"=>"required|email",
        "phone"=>"required|string|min_digits:11|max_digits:15",
        "message"=>"required"
        ];
    }
}

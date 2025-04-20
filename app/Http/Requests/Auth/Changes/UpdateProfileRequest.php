<?php

namespace App\Http\Requests\Auth\Changes;

use Illuminate\Support\Facades\Cache;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
   public function authorize(): bool
    {
        return true;
    }
   protected function prepareForValidation(): void
   {
    $otp = rand(100000, 999999);

    if ($this->has('email') && $this->email !== auth()->user()->email) {
        Cache::put('otp_' . $this->email, $otp, now()->addMinutes(10));
    }

    $this->merge([
        'otp' => $otp,
    ]);
   }

    public function rules(): array
    {
        $userId = auth()->id();
        return [
        'name' => 'required|string|min:2|max:45',
        "phone"=>"required|string|min_digits:11|max_digits:15",
        "email" => 'required|email|unique:users_users,email,' . $userId,
        "bio"=> "string|min:2|max:255",
        "government"=>"required|string",
        "country"=>"required|string",

        ];
    }
}
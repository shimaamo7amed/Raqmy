<?php

namespace App\Http\Requests\Auth;

use App\Services\Users\UsersUsersServices;
use Illuminate\Foundation\Http\FormRequest;
// use App\Models\Countries\CountriesCountriesM;
// use App\Models\Countries\CountriesGovernmentM;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    
    protected function prepareForValidation(): void
    {
        $this->merge([
            'code' => UsersUsersServices::GenerateNewCode(),
            'otp' => rand(123652, 986412),
        ]);

        // $countryName = CountriesCountriesM::find($this->country_id)?->label_en;
        // $governmentName = CountriesGovernmentM::find($this->government_id)?->label_en;
        //     $location = json_encode([
        //         'government_name' => $governmentName,
        //         'country_name' => $countryName,
        //     ]);
        //     $country = json_encode([
        //         'country_name' => $countryName,
        //         'country_id' => $this->country_id,
        //     ]);
        //     $this->merge([
        //         'location' => $location,
        //         'country' => $country,
        //     ]);
    }


    public function rules(): array
    {
        return [
            "code" => "required|unique:users_users,code",
            "name" => "required|string|min:3|max:25",
            "userName" => "required|string|unique:users_users,userName",
            "email" => "required|email|unique:users_users,email",
            'password' => [
                'required',
                'string',
                'min:10',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*#?&]/',
                'confirmed'
            ],
            "phone" => "required|min_digits:11|max_digits:15",
            "gender" => "required|string",
            "otp" => "required|numeric",
            "country" => "required|string",
            "government" => "required|string",
        ];
    }

    // private function getGovernmentIdsBasedOnCountry()
    // {
    //     $governmentNames = CountriesGovernmentM::where('country_id', $this->country_id)
    //         ->pluck('id')
    //         ->implode(',');
    //     return $governmentNames;
    // }
}


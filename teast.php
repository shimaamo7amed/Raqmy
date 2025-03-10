 <?php
 
 // protected function prepareForValidation(): void
    // {
    //     $this->merge([
    //         'code' => UsersUsersServices::GenerateNewCode(),
    //         "otp" => rand(123652, 986412),
    //     ]);
    // }
    // public function rules(): array
    // {
    //     return
    //     [
    //         "code" => "required|unique:users_users,code",
    //         "name"=>"required|string|min:3|max:50",
    //         "user_name"=>"required|string|unique:users_users,user_name",
    //         "email"=>"required|email|unique:users_users,email",
    //         'password' =>
    //         [
    //         'required',
    //         'string',
    //         'min:10',
    //         'regex:/[a-z]/',
    //         'regex:/[A-Z]/',
    //         'regex:/[0-9]/',
    //         'regex:/[@$!%*#?&]/',
    //         'confirmed'
    //         ],
    //         "phone" => "required|min_digits:11|max_digits:15",
    //         'country_id' => 'required|exists:countries_countries,id',
    //         "gender" => "required|in:male,female",
    //         'government_id' => 'required|exists:countries_governments,id|in:' . $this->getGovernmentIdsBasedOnCountry(),
    //         "otp" => "required|numeric",
    //         "location" => "string",


    //     ];
    // }
    //   private function getGovernmentIdsBasedOnCountry()
    // {
    //     $governmentNames = CountriesGovernmentM::where('country_id', $this->country_id)
    //         ->pluck('id')
    //         ->implode(',');
    //     return $governmentNames;
    // }
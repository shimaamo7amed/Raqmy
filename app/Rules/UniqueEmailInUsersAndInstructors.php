<?php

  
namespace App\Rules;

use App\Models\FormsInstructorsM;
use App\Models\Users\UsersUsersM;
use Illuminate\Contracts\Validation\Rule;

class UniqueEmailInUsersAndInstructors implements Rule
{
    public function passes($attribute, $value)
    {
        return !(
            UsersUsersM::where('email', $value)->exists() ||
            FormsInstructorsM::where('email', $value)->exists()
        );
    }

    public function message()
    {
        return 'Email already exists.';
    }
}


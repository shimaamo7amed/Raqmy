<?php

namespace App\Services\Users;

use Illuminate\Support\Str;
use App\Models\Users\UsersUsersM;

class UsersUsersServices
{
    static public function GenerateNewCode()
    {
        $code = Str::random(6);
        if (UsersUsersM::where('code', $code)->exists()) {
            return Self::GenerateNewCode();
        } else {
            return $code;
        }
    }

    static public function myCoursesInstructors()
    {

     $courses = UsersUsersM::where('role_id', 2)
    ->with('courses')
    ->get()
    ->pluck('courses')
    ->flatten(); // يجمع كل الكورسات في مجموعة واحدة
        dd($courses);
    }

}
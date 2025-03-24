<?php

namespace App\Services\instructories;
use App\Models\Instructors\InstructorsInstructorsM;

class instructoriesServices
{

    public static function GetAll($limit=10)
    {
        $query = InstructorsInstructorsM::query();
        return $query->paginate($limit);
    }

    public static function GetByCode($code)
    {
    $instructor = InstructorsInstructorsM::with('courses')->where('code', $code)->first();
    // dd($instructor);
    if ($instructor) {
        return $instructor;
    }else {
        return null;
    }
    }
}



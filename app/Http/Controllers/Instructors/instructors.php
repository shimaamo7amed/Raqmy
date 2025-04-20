<?php

namespace App\Http\Controllers\Instructors;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Users\UsersUsersServices;
use App\Services\system\SystemApiResponseServices;
use App\Models\Instructors\InstructorsInstructorsM;
use App\Services\instructories\instructoriesServices;

class instructors extends Controller
{
   public function GetAll()
   {
        try {
                $instructors=instructoriesServices::GetAll();
                // dd($instructors);
                if ($instructors) {
                        return  SystemApiResponseServices::ReturnSuccess(
                            ["instructors"=>$instructors],
                            __(""),
                            null
                        );
                    } else {
                        return  SystemApiResponseServices::ReturnFailed(
                            [],
                            __(""),
                            null
                        );
                    }
            }catch (\Throwable $th) {
                return SystemApiResponseServices::ReturnError(
                        9800,
                        null,
                        $th->getMessage(),
                    );
            }
   }

   public function GetByCode($code)
   {
    try {
    $instructor=instructoriesServices::GetByCode($code);
                // dd($instructor);
                if ($instructor) {
                        return  SystemApiResponseServices::ReturnSuccess(
                            ["instructor"=>$instructor],
                            __(""),
                            null
                        );
                    } else {
                        return  SystemApiResponseServices::ReturnFailed(
                            [],
                            __(""),
                            null
                        );
                    }
            }catch (\Throwable $th) {
                return SystemApiResponseServices::ReturnError(
                        9800,
                        null,
                        $th->getMessage(),
                    );
            }
   }

   public function myCoursesInstructors()
   {
       $myCourses = UsersUsersServices::myCoursesInstructors();
   }
}

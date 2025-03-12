<?php

namespace App\Http\Controllers\Courses;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Courses\CoursesCoursesM;
use App\Services\Courses\CoursesServices;
use App\Services\system\SystemApiResponseServices;

class courses extends Controller
{
    public function GetAll()
    {
        try {
            $Courses = CoursesServices::GetAllCourses();
            if ($Courses) {
                return SystemApiResponseServices::ReturnSuccess(
                    ["Courses" => $Courses],
                    __(""),
                    null
                );
            } else {
                return SystemApiResponseServices::ReturnFailed(
                    null,
                    __(""),
                    null
                );
            }
        } catch (\Throwable $th) {
            return SystemApiResponseServices::ReturnError(
                9800,
                null,
                $th->getMessage(),
            );
        }
    }
}


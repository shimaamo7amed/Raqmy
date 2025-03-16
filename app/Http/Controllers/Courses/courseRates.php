<?php

namespace App\Http\Controllers\Courses;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Courses\CoursesServices;
use App\Http\Requests\Courses\courseRatesRequest;
use App\Services\system\SystemApiResponseServices;

class courseRates extends Controller
{
    public function CourseRates(courseRatesRequest $data)
    {

      try {
            $courseRates=CoursesServices::CourseRates($data->validated());
            if ($courseRates) {
                return SystemApiResponseServices::ReturnSuccess(
                    ["courseRates" => $courseRates],
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

<?php

namespace App\Services\Programs;

use App\Models\programs\ProgramsProgramsM;
use App\Services\system\SystemApiResponseServices;

class ProgramsServices
{
    public static function GetAllprograms($limit = 10)
    {
        $programs =ProgramsProgramsM::select('code','title', 'desc', 'total_price','price_after', 'courses_hour', 'courses_number', 'courses_image')
        ->paginate($limit);
        if ($programs->isEmpty()) {
            return SystemApiResponseServices::ReturnSuccess(
                [],
                __('no_programs_found'),
                null
            );
        }

        return $programs;
    }
    public static function GetByCode($code)
    {
        $program =ProgramsProgramsM::with([
                "courses",
                "courses.instructor",
            ])->where("code", $code)->first();
        return $program ?: null;
    }

}




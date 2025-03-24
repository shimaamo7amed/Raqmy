<?php

namespace App\Http\Controllers\Programs;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Programs\ProgramsServices;
use App\Services\system\SystemApiResponseServices;

class Programs extends Controller
{
     public function GetAll()
    {
        try {
            $Programs = ProgramsServices::GetAllPrograms();
            if ($Programs) {
                return SystemApiResponseServices::ReturnSuccess(
                    ["Programs" => $Programs],
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

    public function GetByCode($code)
    {
        try {
            $program = ProgramsServices::GetByCode($code);
            if ($program) {
                return SystemApiResponseServices::ReturnSuccess(
                    ["program" => $program],
                    __(""),
                    null
                );
            } else {
                return SystemApiResponseServices::ReturnFailed(
                    [],
                    __('no_program_found'),
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

<?php

namespace App\Http\Controllers\Forms;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Forms\InstructorsRequest;
use App\Services\Forms\FormsInstructorsServices;
use App\Services\system\SystemApiResponseServices;

class InstructorsForm extends Controller
{
    public function Instructors(InstructorsRequest $request)
    {
        try {
            $formData = FormsInstructorsServices::InstructorsForm($request->validated());

            return SystemApiResponseServices::ReturnSuccess(
                [],
                __("Thanks, The Admin will contact you soon.."),
                null
            );

        } catch (\Throwable $th) {
            return SystemApiResponseServices::ReturnError(
                9800,
                null,
                $th->getMessage(),
            );
        }
    }

}

<?php

namespace App\Http\Controllers\Forms;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Forms\InstructorsRequest;
use App\Services\Forms\FormsInstructorsServices;
use App\Services\system\SystemApiResponseServices;

class Instructors extends Controller
{
    public function Instructors(InstructorsRequest $data)
    {
       try {
      $formData=FormsInstructorsServices::InstructorsForm($data->validated());
                // dd($formData);
                if ($formData) {
                        return  SystemApiResponseServices::ReturnSuccess(
                            [],
                            __("Thanks,will contact you soon.."),
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
}

<?php

namespace App\Http\Controllers\Forms;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Forms\ContactUsRequest;
use App\Services\Forms\FormsContactUsServices;
use App\Services\system\SystemApiResponseServices;

class ContactUS extends Controller
{
    public function ContactUS(ContactUsRequest $data)
    {
       try {
      $formData=FormsContactUsServices::ContactUS($data->validated());
                // dd($formData);
                if ($formData) {
                        return  SystemApiResponseServices::ReturnSuccess(
                            [],
                            __("Thanks For Contact Us.."),
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

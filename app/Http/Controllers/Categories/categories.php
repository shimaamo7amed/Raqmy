<?php

namespace App\Http\Controllers\Categories;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\categories\CategoriesServices;
use App\Services\system\SystemApiResponseServices;

class categories extends Controller
{
    public function GetAll()
    {
    try {
    $Categories=CategoriesServices::GetAll();
        // dd($Categories);
                if ($Categories) {
                        return  SystemApiResponseServices::ReturnSuccess(
                            ["Categories"=>$Categories],
                            __(""),
                            null
                        );
                    } else {
                        return  SystemApiResponseServices::ReturnFailed(
                            null,
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

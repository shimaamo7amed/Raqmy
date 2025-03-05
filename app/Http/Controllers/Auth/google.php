<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Users\GoogleServices;
use Laravel\Socialite\Facades\Socialite;
use App\Services\system\SystemApiResponseServices;

class google extends Controller
{
    public function redirectToGoogle()
    {
    return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {

        try {
            $data = GoogleServices::handleGoogleCallback();
        // dd($data);
                if ($data) {
                        // return  SystemApiResponseServices::ReturnSuccess(
                        //     ["data"=>$data],
                        //     __(""),
                        //     null
                        // );
// return redirect('http://localhost:5176?token=' . $data['access_token']);
      $queryParams = http_build_query($data);
            return redirect('http://localhost:5173?' . $queryParams);
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



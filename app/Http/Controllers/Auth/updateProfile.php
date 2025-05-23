<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\services\Auth\UpdateProfileServices;
use App\Services\system\SystemApiResponseServices;
use App\Http\Requests\Auth\Changes\EmailOTPRequest;
use App\Http\Requests\Auth\Changes\ChangeNameRequest;
use App\Http\Requests\Auth\Changes\ChangeEmailRequest;
use App\Http\Requests\Auth\Changes\ChangeImageRequest;
use App\Http\Requests\Auth\Changes\ChangePhoneRequest;
use App\Http\Requests\Auth\Changes\UpdateProfileRequest;
use App\Http\Requests\Auth\Changes\ChangeLocationRequest;
use App\Http\Requests\Auth\Changes\ChangePasswordRequest;
use App\Http\Requests\Auth\Changes\ChangeUserNameRequest;

class updateProfile extends Controller
{
    public function ChangePassword(ChangePasswordRequest $data)
    {
        try {
            $user = UpdateProfileServices::ChangePassword($data->validated());
            // dd($user);
            if ($user) {
                return  SystemApiResponseServices::ReturnSuccess(
                    [],
                    __("Your Password Changed Succ"),
                    null
                );
            } else {
                return  SystemApiResponseServices::ReturnFailed(
                    [],
                    __("try Again..!"),
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

    public function UpdateProfile(UpdateProfileRequest $data)
    {
        try {
            $user = UpdateProfileServices::UpdateProfile($data->validated());
            // dd($user);
            if ($user) {
                return  SystemApiResponseServices::ReturnSuccess(
                    ["userInfo" => $user],
                    __("Your Profile Updated Succ"),
                    null
                );
            } else {
                return  SystemApiResponseServices::ReturnFailed(
                    [],
                    __("try Again..!"),
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

    public function ChangeImage(ChangeImageRequest $data)
    {
        try {
            $user = UpdateProfileServices::ChangeImage($data->validated());
            // dd($user->image);
            if ($user) {
                return  SystemApiResponseServices::ReturnSuccess(
                    ["userImage" => $user->image],
                    __("Your Porifle Photo Updated Succ"),
                    null
                );
            } else {
                return  SystemApiResponseServices::ReturnFailed(
                    [],
                    __("try Again..!"),
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
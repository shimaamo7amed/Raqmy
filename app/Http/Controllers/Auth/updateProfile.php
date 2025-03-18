<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\services\Auth\UpdateProfileServices;
use App\Services\system\SystemApiResponseServices;
use App\Http\Requests\Auth\Changes\EmailOTPRequest;
use App\Http\Requests\Auth\Changes\ChangeNameRequest;
use App\Http\Requests\Auth\Changes\ChangeEmailRequest;
use App\Http\Requests\Auth\Changes\ChangePhoneRequest;
use App\Http\Requests\Auth\Changes\ChangeLocationRequest;
use App\Http\Requests\Auth\Changes\ChangePasswordRequest;
use App\Http\Requests\Auth\Changes\ChangeUserNameRequest;

class updateProfile extends Controller
{
    public function ChangePassword(ChangePasswordRequest $data)
    {
        try {
            $user=UpdateProfileServices::ChangePassword($data->validated());
            // dd($user);
            if ($user) {
                return  SystemApiResponseServices::ReturnSuccess(
                [],
                __("Your Password Changed Succ"),
                null
                );
            }
            else
            {
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
    public function ChangeName(ChangeNameRequest $data)
    {
        try {
            $user=UpdateProfileServices::ChangeName($data->validated());
            // dd($user);
            if ($user) {
                return  SystemApiResponseServices::ReturnSuccess(
                ["Name"=>$user->name],
                __("Your Name Changed Succ"),
                null
                );
            }
            else
            {
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

    public function ChangeUserName(ChangeUserNameRequest $data)
    {
        try {
            $user=UpdateProfileServices::ChangeUserName($data->validated());
            // dd($user);
            if ($user) {
                return  SystemApiResponseServices::ReturnSuccess(
                ["user_name"=>$user->user_name],
                __("Your UserName Changed Succ"),
                null
                );
            }
            else
            {
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
   

    public function ChangePhone(ChangePhoneRequest $data)
    {
        try {
            $user=UpdateProfileServices::ChangePhone($data->validated());
            // dd($user);
            if ($user) {
                return  SystemApiResponseServices::ReturnSuccess(
                ["phone"=>$user->phone],
                __("Your Phone Changed Succ"),
                null
                );
            }
            else
            {
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
    public function ChangeLocation(ChangeLocationRequest $data)
    {
        try {
            $user=UpdateProfileServices::ChangeLocation($data->validated());
            // dd($user);
            if ($user) {
                return  SystemApiResponseServices::ReturnSuccess(
                [
                  "location" => $user->location,
                  "country" => $user->country
                ],
                __("Your Location Changed Succ"),
                null
                );
            }
            else
            {
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


    public function EmailOTP(Request $request)
    {
        $request->validate([
            'new_email' => 'required|email|unique:users_users,email',
        ]);
        return response()->json(UpdateProfileServices::EmailOTP($request->new_email));
    }
    public function ChangeEmail(Request $request)
    {
        $request->validate([
            'new_email' => 'required|email',
            'otp' => 'required|digits:6',
        ]);

        return response()->json(UpdateProfileServices::ChangeEmail($request->user(), $request->new_email, $request->otp));
    }

}

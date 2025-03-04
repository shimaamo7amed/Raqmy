<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\services\Auth\AuthServices;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\ResendOtpRequest;
use App\Http\Requests\Auth\VerifyEmailRequest;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use App\Http\Requests\Auth\UpdateProfileRequest;
use App\Http\Requests\Auth\ForgetPasswordRequest;
use App\Services\system\SystemApiResponseServices;
use Illuminate\Routing\Controller as BaseController;

class authintication extends BaseController
{
    public function Register(RegisterRequest $data)
    {
        try {
            $user = DB::transaction(function () use ($data) {
                return AuthServices::Register($data->validated());
            });
            if ($user) {
                return  SystemApiResponseServices::ReturnSuccess(
                    ["user" => $user],
                    __("Register Successfully"),
                    null
                );
            } else {
                return  SystemApiResponseServices::ReturnFailed(
                    null,
                    __("Register Failed"),
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

    public function VerifyEmail(VerifyEmailRequest $data)
    {
        try {
            $user=AuthServices::VerifyEmail($data->validated());
            //    dd($user);
        if ($user) {
                    return  SystemApiResponseServices::ReturnSuccess(
                        [],
                        __("Your Email Verified Succ"),
                        null
                    );
                } else {
                    return  SystemApiResponseServices::ReturnFailed(
                        null,
                        __("Your Email Verified Failed"),
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

    public function ResendOtp(ResendOtpRequest $data)
    {
       try {
        $user=AuthServices::ResendOtp($data->validated());
        //  dd($user);
                if ($user) {
                    return  SystemApiResponseServices::ReturnSuccess(
                        [],
                        __("Check Your Email"),
                        null
                    );
                } else {
                    return  SystemApiResponseServices::ReturnFailed(
                        null,
                        __("Invalid,Try Again..!"),
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

    public function Login(LoginRequest $data)
    {
        try {
            $user=AuthServices::Login($data->validated());
            // dd($user);
            if ($user) {
                    return  SystemApiResponseServices::ReturnSuccess(
                        ["user"=>$user],
                        __("Login Succ"),
                        null
                    );
                } else {
                    return  SystemApiResponseServices::ReturnFailed(
                        null,
                        __("Login Failed"),
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

    public function Logout()
    {
      try {
          JWTAuth::invalidate(JWTAuth::getToken());
            auth()->logout();
            if (!auth()->check()) {
                return SystemApiResponseServices::ReturnSuccess(
                    [],
                    __("Logout Succ"),
                    null
                );
            } else {
                return SystemApiResponseServices::ReturnFailed(
                    [],
                    __("Logout Failed"),
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
    
    public function ForgetPassword(ForgetPasswordRequest $data)
    {
        try {
            $user=AuthServices::ForgetPassword($data->validated());
            // dd($user);
            if ($user) {
                    return  SystemApiResponseServices::ReturnSuccess(
                        [],
                        __("Check Your Email.."),
                        null
                    );
                } else {
                    return  SystemApiResponseServices::ReturnFailed(
                        null,
                        __("Invalid Email..!"),
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
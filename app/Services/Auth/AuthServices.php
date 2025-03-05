<?php


namespace  App\services\Auth;

use Illuminate\Support\Str;
use App\Models\Users\UsersUsersM;
use App\Mail\users\VerifyCodeEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\users\ResetPasswordCode;

class AuthServices
{

  static public function GenerateNewCode()
  {
      $code=Str::random(6);
      if (UsersUsersM::where('code', $code)->exists()) {
      return Self::GenerateNewCode();
      }else{
      return $code;
      }
  }

  static public function Register(array $array)
  {
    // dd($array);
    $user=UsersUsersM::create($array);
    // dd($user);
    Mail::to($user->email)->send(new VerifyCodeEmail($user->otp,$user->name, $user->email));
    return $user;
  }

  static public function VerifyEmail(array $array)
  {
      // dd($array);
      $user=UsersUsersM::where([
      "code"=>$array['user_code'],
      "otp"=>$array['otp']
      ])->first();
      // dd($user);
      if ($user) {
            $user->otp = null;
            $user->save();
            return $user;
      }else {
        return null;
      }
  }
  static public function ResendOtp(array $array)
  {
      $user=UsersUsersM::where(
        "email",$array['email']
      )->first();
      // dd($user);
      if ($user) {
            $newOtp = rand(100000, 999999);
            $user->otp = $newOtp;
            $user->save();
            Mail::to($user->email)->send(new VerifyCodeEmail($newOtp, $user->fname, $user->email));
            $token = auth()->login($user);
            return [
                'user' => $user,
                'token' => $token
            ];
      } else {
            return false;
        }
  }

  static public function Login(array $array)
  {
        $token = auth("api")->attempt([
        'email' => $array['email'],
        'password' => $array['password']
        ]);
        $data = [
            'access_token' => $token,
            'token_type' => 'Bearer',
        ];
        return $token ? $data : null;
  }

  static public function Logout()
  {
      return auth()->logout();
      return auth("api")->user();
      return auth("api")->logout();
  }

  static public function ForgetPassword(array $array)
  {
      $user = UsersUsersM::where('email', $array['email'])->first();
      if (!$user)
      {
        return null;
      }
      $otp = $array['otp'];
      Mail::to($user->email)->send(new ResetPasswordCode($otp, $user->name, $user->email));
      $user->otp = $otp;
      $user->save();

      return $user;
  }

  static public function ValidateOtp(array $array)
  {
    
  }


}
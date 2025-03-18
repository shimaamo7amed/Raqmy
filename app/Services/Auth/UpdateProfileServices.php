<?php


namespace  App\services\Auth;

use Illuminate\Support\Str;
use App\Mail\users\EmailOTP;
use App\Models\Users\UsersUsersM;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;

class UpdateProfileServices
{
  static public function ChangePassword(array $array)
  {
     // dd($array);
      $user = Auth::user();
        if (!Hash::check($array['password'], $user->password)) {
          return false;
        }
        $user->password =$array['new_password'];
        $user->save();

        return true;
  }
  static public function ChangeName(array $array)
  {
    $user=Auth::user();
    // dd($user);
    if ($user)
    {
      $user->update(["name"=>$array['name']]);
      // dd($user->name);
      return $user;
    }else {
      return "User Not Found";
    }
 
  }

  static public function ChangeUserName(array $array)
  {
    $user=Auth::user();
    // dd($user);
    if ($user)
    {
      $user->update(["user_name"=>$array['user_name']]);
      // dd($user->user_name);
      return $user;
    }else {
      return "User Not Found";
    }
 
  }
  
  static public function ChangePhone(array $array)
  {
    $user=Auth::user();
    // dd($user);
    if ($user)
    {
      $user->update(["phone"=>$array['phone']]);
      // dd($user->phone);
      return $user;
    }else {
      return "User Not Found";
    }
 
  }

  static public function ChangeLocation(array $array)
  {
    $user=Auth::user();
    // dd($user);
    if ($user)
    {
      $user->update([
        "location"=>$array['location'],
        "country"=>$array['country']
      ]);
      // dd($user->location);
     return $user;
    }else {
      return "User Not Found";
    }
 
  }
  static public function EmailOTP($newEmail)
  {
    $user=Auth::user();
    if ($user) {
    $otp = rand(100000, 999999);
    Cache::put('otp_' . $newEmail, $otp, now()->addMinutes(10));
    Mail::to($newEmail)->send(new EmailOTP($otp,$user->name, $newEmail));
    return ['message' => 'OTP sent successfully.'];
    }
    else {
      return ['message' => 'Try Again.'];
    }
  
  }

  static public function ChangeEmail($user, $newEmail, $otp)
  {
        $cachedOtp = Cache::get('otp_' . $newEmail);

        if (!$cachedOtp || $cachedOtp != $otp) {
          return ['error' => 'Invalid OTP'];
        }
        $user->update(['email' => $newEmail]);
        Cache::forget('otp_' . $newEmail);

        return ['message' => 'Email updated successfully.'];
  }

}
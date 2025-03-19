<?php
namespace  App\services\Auth;

use Illuminate\Support\Str;
use App\Mail\users\EmailOTP;
use App\Models\Users\UsersUsersM;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;


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


  static public function UpdateProfile(UsersUsersM $user, array $data)
  {
    $emailChanged = false;
    if (isset($data['email']) && $data['email'] !== $user->email) {
        $otp = rand(100000, 999999);
        Cache::put('otp_' . $data['email'], $otp, now()->addMinutes(10));

        Mail::to($data['email'])->send(new EmailOTP($otp, $user->name, $data['email']));

        unset($data['email']);
        $emailChanged = true;
    }

    if (isset($data['image']) && $data['image']->isValid()) {
        $path = $data['image']->store('profile_images', 'public');
        $data['image'] = $path;
    }

    $user->update($data);

    if ($emailChanged) {
        return response()->json([
          'message' => ' Please verify your email OTP.'
        ]);
    }

    return response()->json([
        'message' => 'Profile updated successfully.',
        'updated_data' => $user->fresh()
    ]);
  }


  static public function verifyOtpAndUpdateEmail(UsersUsersM $user, string $otp, string $email)
  {
    $cachedOtp = Cache::get('otp_' . $email);
    if ($cachedOtp && $cachedOtp == $otp) {
        $user->update(['email' => $email]);
        Cache::forget('otp_' . $email);
        return response()->json([
            'message' => 'Email verified and updated successfully.',
            'updated_data' => $user->fresh()
        ]);
    }

    return response()->json(['message' => 'Invalid OTP.'], 400);
  }
  


}
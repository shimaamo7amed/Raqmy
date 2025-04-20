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


  static public function UpdateProfile(array $data)
  {
    // dd($data);
      $user=auth()->user();
      if (!$user) {
            throw new \Exception('User not found.');
        }
      $user->update($data);
      // dd($user);
       return $user;
  }

  static public function ChangeImage(array $data)
  {
    $user = auth()->user();
    if (!$user) {
      throw new \Exception('User not found.');
    }
        if ($user->image && \Storage::exists($user->image)) {
            \Storage::delete($user->image);
        }
        if (!isset($data['image']) || !$data['image']->isValid()) {
            throw new \Exception('Invalid image uploaded.');
        }
        $path = $data['image']->store('users/images', 'public');
        $user->image = $path;
        $user->save();
        // dd($user);
        return $user;
    }

  


}
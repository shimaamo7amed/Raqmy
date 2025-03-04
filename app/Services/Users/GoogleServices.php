<?php
namespace App\Services\Users;

use App\Models\Users\UsersUsersM;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class GoogleServices
{
    static public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->user();
        // dd($googleUser);
        // dd($googleUser->id);

        $user = UsersUsersM::where('social_id', $googleUser->id)->first();
        // dd($user);
        if ($user) {
            Auth::login($user);
        } else {
            $user = UsersUsersM::create([
            'code' => rand(100000, 999999),
            'name' => $googleUser->name,
            'user_name' => $googleUser->name . rand(1000, 9999),
            'email' => $googleUser->email,
            'social_id' => $googleUser->id,
            'social_type' => 'Google',
            'password' => Hash::make('my-google'),
            ]);
            Auth::login($user);
        }
        $token = auth('api')->login($user);
            return [
                'access_token' => $token,
                'token_type' => 'Bearer',
                'user' => $user,
            ];
    }

}
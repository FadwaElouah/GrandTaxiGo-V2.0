<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Exception;

class SocialiteController extends Controller
{
    //Google
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            $finduser = User::where('provider_id', $user->id)
                ->where('provider', 'google')
                ->first();

            if ($finduser) {
                Auth::login($finduser);
                return redirect('/dashboard');
            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'password' => bcrypt(rand(100000, 999999)),
                    'provider' => 'google',
                    'provider_id' => $user->id,
                    'avatar' => $user->avatar,
                ]);

                Auth::login($newUser);
                return redirect('/dashboard');
            }
        } catch (Exception $e) {
            return redirect('/login')->with('error', 'حدث خطأ أثناء تسجيل الدخول باستخدام Google');
        }
    }

    // Facebook
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        try {
            $user = Socialite::driver('facebook')->user();
            $finduser = User::where('provider_id', $user->id)
                ->where('provider', 'facebook')
                ->first();

            if ($finduser) {
                Auth::login($finduser);
                return redirect('/dashboard');
            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email ?? $user->id.'@facebook.com',
                    'password' => bcrypt(rand(100000, 999999)),
                    'provider' => 'facebook',
                    'provider_id' => $user->id,
                    'avatar' => $user->avatar,
                ]);

                Auth::login($newUser);
                return redirect('/dashboard');
            }
        } catch (Exception $e) {
            return redirect('/login')->with('error', 'حدث خطأ أثناء تسجيل الدخول باستخدام Facebook');
        }
    }
}

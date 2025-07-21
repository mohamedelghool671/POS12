<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class ProviderController extends Controller
{
    //login process for google and github
    //redirect sociallize
    public function redirect($provider){
            return Socialite::driver($provider)->redirect();
    }
    //callback socialite
    public function callback($provider){
            $socialUser = Socialite::driver($provider)->user();

            // ابحث عن المستخدم بالإيميل
            $user = User::where('email', $socialUser->email)->first();

            if ($user) {
                $user->email_verified_at = now();
                $user->save();
                Auth::login($user);
            } else {
                // لو مش موجود: أنشئه وسجل دخوله
                $user = \App\Models\User::create([
                    'provider'       => $provider,
                    'provider_id'    => $socialUser->id,
                    'name'           => $socialUser->name,
                    'nickname'       => $socialUser->nickname,
                    'email'          => $socialUser->email,
                    'provider_token' => $socialUser->token,
                    'role'           => 'user', // النوع يوزر
                    'email_verified_at' => now(),
                ]);
                Auth::login($user);
            }

            // بعد كده حوله للداشبورد أو أي صفحة رئيسية
            return redirect()->route('userDashboard');

    }
}

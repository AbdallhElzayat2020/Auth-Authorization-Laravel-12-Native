<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    public function redirect($driver)
    {
        return Socialite::driver($driver)->redirect();
    }

    public function callback($driver)
    {
        $githubUser = Socialite::driver($driver)->user();

        $user = User::firstOrCreate(
            ['email' => $githubUser->getEmail()],
            [
                'name' => $githubUser->getName(),
                'password' => Hash::make('12345678'),
                'email_verified_at' => now(),
                'otp' => rand(100000, 999999),
            ]
        );

        Auth::login($user);
        return redirect()->intended(route('profile'))->with('success', 'Login successful');
    }
}

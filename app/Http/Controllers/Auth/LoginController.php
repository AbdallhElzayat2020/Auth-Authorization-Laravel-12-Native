<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Mail\VerifyAccountOtpMail;
use App\Models\User;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        $user = User::whereEmail($request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return redirect()->back()->with('error', 'Invalid credentials, please try again.');
        }
        if (!$user->email_verified_at) {
            Mail::to($user->email)->send(new VerifyAccountOtpMail($user->otp, $user->email));
            return redirect()->route('verify-email.form-show', $user->email);
        }

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/profile')->with('success', 'Login successful.');
        }
        return redirect()->back()->with('error', 'Invalid credentials, please try again.');

    }
}

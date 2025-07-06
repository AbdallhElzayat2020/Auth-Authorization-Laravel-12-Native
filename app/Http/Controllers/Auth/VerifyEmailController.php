<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\VerifyEmailOtpRequest;
use App\Models\User;
use Illuminate\Http\Request;

class VerifyEmailController extends Controller
{
    public function showVerifyEmailForm($email)
    {
        return view('auth.verify-email', ['email' => $email]);
    }

    public function verifyEmail(VerifyEmailOtpRequest $request)
    {
        $otp = implode("", $request->otp);
        $user = User::whereEmail($request->email)->first();
        if ($user->otp !== $otp) {
            return redirect()->back()->with('error', 'Invalid OTP. Please try again.');
        }
        $user->email_verified_at = now();
        $user->otp = null;
        $user->save();
        return redirect()->route('show-login-form')->with('success', 'Email verified successfully, you can now login.');
    }
}

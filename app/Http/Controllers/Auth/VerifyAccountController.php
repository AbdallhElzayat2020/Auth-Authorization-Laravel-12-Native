<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SendVerificationOtpRequest;
use App\Http\Requests\Auth\VerifyEmailOtpRequest;
use App\Mail\VerifyAccountOtpMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class VerifyAccountController extends Controller
{
    public function showVerifyAccountForm($identifier)
    {
        return view('auth.verify-account', ['identifier' => $identifier]);
    }


    public function sendOtp(SendVerificationOtpRequest $request)
    {
        $user = User::where('email', $request->identifier)
            ->orWhere('phone', $request->identifier)
            ->first();

        if ($user->account_verified_at) {
            return redirect()->route('show-login-form')->with('success', 'Account already verified');
        }
        if ($request->type === 'email') {
            Mail::to($user->email)->send(new VerifyAccountOtpMail($user->otp, $user->email));
        }
        if ($request->type === 'phone') {
            if (!$user->phone || $user->phone == '') {
                return back()->with('error', 'You do not have a phone number ');
            }

            dd('otp sent to phone');
        }

        return redirect()->route('verify-account.form-show', $user->email);
    }

    public function verifyAccount(VerifyEmailOtpRequest $request)
    {
        $otp = implode("", $request->otp);
        $user = User::where('email', $request->identifier)
            ->orWhere('phone', $request->identifier)
            ->first();

        if ($user->otp !== $otp) {
            return redirect()->back()->with('error', 'Invalid OTP or account data');
        }

        $user->account_verified_at = now();
        $user->otp = null;
        $user->save();
        return redirect()->route('show-login-form')->with('success', 'Account verified successfully, you can now login.');
    }
}
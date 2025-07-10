<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SendVerificationOtpRequest;
use App\Http\Requests\Auth\VerifyEmailOtpRequest;
use App\Mail\VerifyAccountOtpMail;
use App\Models\User;
use App\Services\PhoneVerificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class VerifyAccountController extends Controller
{
    public function __construct(public PhoneVerificationService $phoneVerificationService)
    {

    }

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
            return redirect()->route('login')->with('success', 'Account already verified');
        }
        if ($request->type === 'email') {
            Mail::to($user->email)->send(new VerifyAccountOtpMail($user->otp, $user->email));
        }
        if ($request->type === 'phone') {
            if (!$user->phone || $user->phone == '') {
                return back()->with('error', 'You do not have a phone number ');
            }

            try {
                $response = $this->phoneVerificationService->sendOtpMessage($user->phone, $user->otp);
                if ($response->failed()) {
               Log::info($response);
                    return back()->with('error', 'Failed to send OTP to this phone ! try again later');
                }
            } catch (\Exception $exception) {
                return back()->with('error', $exception->getMessage());

            }
        }

        return redirect()->route('verify-account.form-show', $request->type == 'phone' ? $user->phone : $user->otp)
            ->with('success', 'OTP sent successfully');
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
        return redirect()->route('login')->with('success', 'Account verified successfully, you can now login.');
    }
}
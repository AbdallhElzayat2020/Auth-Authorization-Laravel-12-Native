<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Mail\VerifyAccountOtpMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {
        try {
            DB::beginTransaction();

            $otp = rand(100000, 999999);
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'otp' => $otp,
            ]);

            Mail::to($request->email)->send(new VerifyAccountOtpMail($user->otp, $user->email));
            DB::commit();

            return redirect()->route('verify-email.form-show', $user->email);
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('error', 'An error occurred while processing your request. Please try again later.');
        }
    }
}

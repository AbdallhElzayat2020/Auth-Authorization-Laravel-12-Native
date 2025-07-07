<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\PasswordLessMagicMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class PasswordLessController extends Controller
{
    public function ShowPasswordLessForm()
    {
        return view('auth.passwordless-login');
    }

    public function submitForm(Request $request)
    {
        $request->validate(['email' => ['required', 'email', 'exists:users,email', 'string']]);

        $user = User::whereEmail($request->email)->first();

        $url = URL::temporarySignedRoute('password-less-user-login-handler', now()->addMinutes(10), ['user' => $user->id]);

        Mail::to($user->email)->send(new PasswordLessMagicMail($url));

        return redirect()->back()->with('success', 'Login link sent to your email. Please check your inbox.');
    }

    public function loginHandler(User $user)
    {
        Auth::login($user);
        return redirect()->intended('/profile')->with('success', 'Login successful.');
    }
}

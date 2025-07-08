<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UpdateProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        return view('auth.profile');
    }

    public function update(UpdateProfileRequest $request)
    {
        $user = Auth::user();
        if (!$user) {
            abort(404);
        }
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);
        return redirect()->route('profile')->with('success', 'updated successfully');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('show-login-form')->with('success', 'Logout successful');
    }
}

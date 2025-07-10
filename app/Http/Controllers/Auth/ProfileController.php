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
        $data = $request->validated();

        $data['logout_other_devices'] = $request->has('logout_other_devices') ? true : false;

        $user->update($data);

        return redirect()->route('profile')->with('success', 'updated successfully');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Logout successful');
    }
}

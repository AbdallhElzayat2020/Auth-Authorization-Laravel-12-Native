<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ChangePasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function changePassword(ChangePasswordRequest $request)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->back()->with(['error' => 'You must be logged in to change your password.']);
        }

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->with(['error' => 'The current password is incorrect.']);
        }

        try {
            $user->update(['password' => Hash::make($request->new_password)]);
            return redirect()->back()->with('success', 'Password changed successfully.');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }
}

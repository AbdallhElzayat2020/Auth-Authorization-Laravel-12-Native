<?php

use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\Auth\ForgetPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\PasswordLessController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\SocialAuthController;
use App\Http\Controllers\Auth\VerifyAccountController;
use Illuminate\Support\Facades\Route;
use App\Models\Session;

Route::get('/', function () {
    return view('welcome');
});


/* Social Auth Routes */
Route::controller(SocialAuthController::class)->group(function () {
    Route::get('auth/{driver}/callback', 'callback')->name('social-auth.callback');

    Route::get('auth/{driver}/redirect', 'redirect')->name('social-auth.redirect');
});


/* register Routes */
Route::controller(RegisterController::class)->group(function () {
    Route::get('register', 'showRegisterForm')->name('show-register-form');

    Route::post('register', 'register')->name('register');
});

/* login Routes */
Route::controller(LoginController::class)->group(function () {
    Route::get('login', 'showLoginForm')->name('login');

    Route::post('login', 'login')->name('handle-login');
});

/* Forgot Password */
Route::controller(ForgetPasswordController::class)->group(function () {
    Route::get('forget-password', 'showForgetPasswordForm')->name('show-forget-password-form');

    Route::post('forget-password', 'submitForgetPassword')->name('password-forget.submit');
});

/* Reset Password */
Route::controller(ResetPasswordController::class)->group(function () {
    Route::get('reset-password/{token}', 'showResetPasswordForm')->name('show-reset-password-form');

    Route::post('reset-password', 'SubmitResetPassword')->name('password-reset.submit');
});

/* Password Less Auth */
Route::controller(PasswordLessController::class)->group(function () {
    Route::get('password-less', 'ShowPasswordLessForm')->name('show-password-less-form');

    Route::post('password-less', 'submitForm')->name('password-less.submit');

    Route::get('password-less/{user}', 'loginHandler')->name('password-less-user-login-handler')->middleware('signed');
});


/* sessions */
Route::get('sessions', function () {
    return Session::all();
});

/* Verify account with otp */
Route::controller(VerifyAccountController::class)->group(function () {
    Route::get('verify-account/{identifier}', 'showVerifyAccountForm')->name('verify-account.form-show');
    Route::post('verify-account', 'verifyAccount')->name('verify-account.submit');
    Route::post('send-verification-otp', 'sendOtp')->name('send-verification-otp');
});


/* Authenticated Routes */
Route::middleware(['auth', 'auth.session'])->group(function () {
    /* Protected Routes */
    Route::controller(ProfileController::class)->group(function () {
        Route::get('profile', 'index')->name('profile');
        Route::put('profile/update', 'update')->name('profile.update');
        Route::post('logout', 'logout')->name('logout');
        Route::post('logout/{session}', 'logoutDevice')->name('logout.session');
    });

    Route::put('change-password', [ChangePasswordController::class, 'changePassword'])->name('change-password');
});


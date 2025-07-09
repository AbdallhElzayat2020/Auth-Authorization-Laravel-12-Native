<?php

namespace App\Http\Middleware\Auth;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::user()) {
            return redirect()->route('show-login-form')->with('error', 'You must be logged in to access this page.');
        }

        if (Auth::user()->account_verified_at === null) {
            return redirect()->route('verify-account.form-show', Auth::user()->email)
                ->with('error', 'Please verify your account before accessing this page.');
        }

        return $next($request);
    }
}

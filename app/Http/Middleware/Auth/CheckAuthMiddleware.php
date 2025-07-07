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

        if (Auth::user()->email_verified_at === null) {
            return redirect()->route('verify-email.form-show', Auth::user()->email)
                ->with('error', 'Please verify your email before accessing this page.');
        }

        return $next($request);
    }
}

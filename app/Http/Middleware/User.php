<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class User
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user()->role == 1) {
            return redirect()->route('adminDashboard');
        }
        if (Auth::check() && Auth::user()->activestatus != 1) {
            Auth::logout();
            return redirect()->route('login');
        }
        return $next($request);
    }
}

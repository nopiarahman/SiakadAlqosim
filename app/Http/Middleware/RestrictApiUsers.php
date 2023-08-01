<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RestrictApiUsers
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::user()->hasRole('admin') || !Auth::user()->hasRole('Super-Admin')) {
            Auth::user()->logout(); // Force logout the user
            return redirect('/login')->with('error', 'API users are not allowed to access the web interface.');
        }
    
        return $next($request);
    }
}

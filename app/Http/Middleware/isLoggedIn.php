<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isLoggedIn
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
        // check if user is logged in
        if (!auth()->check()) {
            // if not logged in, redirect to login page
            return redirect()->route('login');
        }

        
        return $next($request);
    }
}

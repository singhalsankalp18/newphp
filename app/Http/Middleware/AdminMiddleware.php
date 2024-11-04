<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is logged in
        if (Auth::check()) {
            // Check if the user's isAdmin attribute is 1 or 2
            if (in_array(Auth::user()->identify_as, [1, 2])) {
                return $next($request);
            }
        }
        // If the user is not logged in or isAdmin is not 1 or 2, return a forbidden response
        return redirect('/');
    }
}

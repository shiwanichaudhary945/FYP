<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        #assuming role_id is 1 for admin
        if (Auth::check() && Auth::user()->role_id==1 || Auth::check() && Auth::user()->role_id==3) {
            return $next($request);
        }

        #return to login if the user id not admin
        return redirect("/");
    }
}

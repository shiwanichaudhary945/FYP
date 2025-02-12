<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LandlordMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
          #assuming role_id is 3 for landlord
          if (Auth::check() && Auth::user()->role_id==3) {
            return $next($request);
        }

        #return to login if the user id not landlord
        return redirect("/");

    }
}

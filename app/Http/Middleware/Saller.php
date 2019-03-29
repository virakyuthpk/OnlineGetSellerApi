<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class Saller
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
        if(Auth::check())
        {
            if(Auth::user()->role=='saller'){
                return $next($request);
            }
        }
        return redirect()->guest('login-register');
        //return $next($request);
    }
}

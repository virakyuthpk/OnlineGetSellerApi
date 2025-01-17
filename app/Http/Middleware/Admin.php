<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class Admin
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
            return $next($request);
           /* if(Auth::user()->role=='admin'){
                return $next($request);
            }*/
             /*if(Auth::user()->role=='member'){
                return $next($request);
            }*/
        }
        return redirect()->guest('admin-login');
    }
}

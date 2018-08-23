<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;

class CheckIfAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
     public function handle($request, Closure $next, $role)
    {
        if(
        Auth::check() == false ||
        Auth::user()->$role != "ADMIN") {
            return redirect('/home');
        }
        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class isAdmin
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
        // membuat cek auth
        if(Auth::user() && Auth::user()->roles == 'ADMIN')
        {
            return $next($request);
        }
        // jika bukan admin redirect ke home
        return redirect('/');

    }
}

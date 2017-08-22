<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            switch(Auth::user()->tipouser_id){
                case 1:
                    return redirect('/administrador');
                    break;
                case 2:
                    return redirect('/personas');
                    break;
                case 3:
                    return redirect('/empresas');
                    break;
            }
            
        }

        return $next($request);
    }
}

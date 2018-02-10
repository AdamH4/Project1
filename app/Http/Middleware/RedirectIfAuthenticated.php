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
            return redirect('/');
        }

        return $next($request);
    }
}
/*
 switch ($guard){
            case 'admin':
                if(Auth::guard($guard)->check()){
                  return redirect('/admin');
                }
            break;

            default:
                if (Auth::guard($guard)->check()) {
                    return redirect()->home();
                }
            break;
        }
return $next($request); takto to bolo upravene*/


/*if ($this->auth->check()) {
        return redirect('/home');
    }

    return $next($request); povodny stav*/


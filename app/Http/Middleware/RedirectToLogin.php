<?php

namespace App\Http\Middleware;
use Session;
use Closure;

class RedirectToLogin
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
        if(!$request->session()->has('datos-loggeo')){
                return redirect()->route('login')->with('success','No tiene permisos para acceder o su sesi&oacute;n ha caducado.');
		}
        return $next($request);
    }
}

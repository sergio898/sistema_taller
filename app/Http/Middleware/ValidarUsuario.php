<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\DB;
use Session;
use Closure;

class ValidarUsuario
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
        $datosLogueoToken = DB::select('select validar_token(?)', [Session::get('datos-loggeo')->token]);
        $datos = explode('|', $datosLogueoToken[0]->validar_token);
        //dd($datos[0]);
        if($datos[0] != 'OK'){
            $request->session()->flush();
            return redirect()->route('login')->with('success','Su acceso a caducado, debe iniciar sesión nuevamente.');

        }
    return $next($request);
    }
}

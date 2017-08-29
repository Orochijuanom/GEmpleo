<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Empresa;

class checkVistas
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
        $empresa = Auth::user()->empresa;

        if($empresa == null){
            return redirect('/empresas/informacion');
        }else{
            $limite = $empresa->limite;
            $vistas = $empresa->vistas()->whereRaw('month(created_at) = '.date('n'))->count('id');
            

            if($vistas >= $limite){
                return redirect('/empresas/informacion')->withErrors(['error' => 'Ha excedido el numero de vistas mensuales de perfiles permitidos "'.$limite.'", por favor comuniquese con el administrador']);
            }

        }
        
        $empresa->vistas()->create(['empresa_id' => $empresa->id]);
        
        return $next($request);
    }
}

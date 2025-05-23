<?php

namespace App\Http\Middleware;

use Closure;

class RestrictUsuarioMiddleware
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
        $usuariosPermitidos = 1;

        if ($request->user()->rol != $usuariosPermitidos) {
            return redirect()->route('home')->with('error', 'No tienes permiso para acceder a esta sección.');
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Verifica si el usuario está autenticado y tiene rol de administrador
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Si no está autenticado, redirige al login
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para acceder al panel de administrador');
        }

        // Si está autenticado pero no es admin, redirige al home
        if (auth()->user()->rol !== 'admin') {
            return redirect()->route('welcome')->with('error', 'No tienes permisos para acceder al panel de administrador');
        }

        return $next($request);
    }
}

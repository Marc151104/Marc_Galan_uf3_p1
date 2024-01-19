<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ValidateUrl
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $url = $request->input('urlImage'); // Cambia 'url' al nombre del parámetro que esperas en la solicitud

        // Validar si la URL es válida
        if ($url !== null && filter_var($url, FILTER_VALIDATE_URL) === false) {
            // La URL no es válida, redirigir a la página de inicio con un mensaje de error
            return redirect('/')->with('error', 'La URL proporcionada no es válida.');
        }

        return $next($request);
    }
}
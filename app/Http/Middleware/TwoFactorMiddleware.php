<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TwoFactorMiddleware
{
    /**
     * Handle an incoming request and enforce two-factor authentication if enabled.
     *
     * @param  \Illuminate\Http\Request  $request  // La solicitud HTTP entrante
     * @param  \Closure  $next  // El siguiente middleware en la pila
     * @return \Symfony\Component\HttpFoundation\Response  // La respuesta procesada
     */
    public function handle(Request $request, Closure $next)
    {
        // Verifica si la autenticación de dos factores está habilitada en la configuración

            $user = auth()->user();
            if (auth()->check() && $user->two_factor_code) {
                // Si el código ha expirado, lo reseteamos
                if ($user->two_factor_expires_at < now()) {
                    $user->resetTwoFactorCode();
                    auth()->logout(); // Cierra la sesión del usuario
                    return redirect()->route('verify.index')->with('error', 'Your verification code expired. Please re-login.');
                }
                if (!$request->is('verify*')) {
                    // Si el usuario no está en la página de verificación, lo redirigimos allí
                    return redirect()->route('verify.index');
                }
            }

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TwoFactorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();
        if (auth()->check() && $user->two_factor_code) {

            if ($user->two_factor_expires_at < now()) {
                // Si el código ha expirado, lo reseteamos
                $user->resetTwoFactorCode();
                auth()->logout(); // Cierra la sesión del usuario
                // Redirige al usuario a la página de verificación con un mensaje de error
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

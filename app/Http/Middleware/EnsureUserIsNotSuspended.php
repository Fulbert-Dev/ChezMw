<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsNotSuspended
{
    /**
     * Déconnecte immédiatement tout utilisateur dont le compte
     * a été suspendu par un administrateur, même si sa session
     * était déjà active au moment de la suspension.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        if ($user && $user->suspended_at) {
            Auth::guard('web')->logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')->withErrors([
                'email' => 'Ce compte a été suspendu. Contactez l’administration.',
            ]);
        }

        return $next($request);
    }
}

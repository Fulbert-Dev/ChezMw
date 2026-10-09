<?php

use App\Http\Middleware\EnsureUserIsNotSuspended;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'role' => RoleMiddleware::class,
        ]);

        // Vérifie la suspension à chaque requête web, pas seulement au login,
        // pour couper immédiatement l'accès d'un compte suspendu en cours de session.
        $middleware->web(append: [
            EnsureUserIsNotSuspended::class,
        ]);

        $middleware->validateCsrfTokens(except: [
            'paygate/callback',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*'),
        );
    })->create();

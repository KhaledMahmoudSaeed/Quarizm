<?php

use App\Http\Middleware\LocalizationMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'loc' => LocalizationMiddleware::class,

        ]);
        $middleware->web(remove: [
            // SubstituteBindings::class,
        ]);
        $middleware->web(append: [
                // \CodeZero\LocalizedRoutes\Middleware\SetLocale::class,
                // SubstituteBindings::class,
            LocalizationMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();

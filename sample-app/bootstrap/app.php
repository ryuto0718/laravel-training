<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\AccessLogger;
// use App\Http\providers\DatabaseServiceProvider;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )

    ->withMiddleware(function (Middleware $middleware) {
        $middleware->prepend(AccessLogger::class);
        // $providers->prepend($DatabaseServiceProvider::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();

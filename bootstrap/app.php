<?php

use Illuminate\Foundation\Application;
use App\Http\Middleware\AuthCheck;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\RoleCheck;
use App\Http\Controllers\UserController;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Tambahkan middleware lain di sini jika perlu
        $middleware->alias([
            'auth.check' => AuthCheck::class,
        ]);

        $middleware->alias([
        'auth.check' => AuthCheck::class,
        'role' => RoleCheck::class,
    ]);

    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })
    ->create();


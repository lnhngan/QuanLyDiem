<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\CheckRole; // <--- THÊM DÒNG NÀY

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Đăng ký alias cho middleware
        $middleware->alias([
            'can' => CheckRole::class, // 'can' là tên alias
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
<?php

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Mailer\Exception\TransportException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        if ($exceptions instanceof HttpException) {
            return response()->json(
                app()->environment('local') ? ['error' => $exceptions->getMessage()] : ['error' => "Httpexception"],
                $exceptions->getStatusCode()
            );
        } elseif (
            $exceptions instanceof QueryException ||
            $exceptions instanceof PDOException
        ) {
            return response()->json(
                app()->environment('local') ?
                    ['error' => $exceptions->getMessage()] : ["error" => "Query exception"],
                500
            );
        } elseif ($exceptions instanceof BadMethodCallException) {
            return response()->json(app()->environment('local') ?
                ['error' => $exceptions->getMessage()] : ["error" => "Bad method call"], 405);
        } elseif ($exceptions instanceof TransportException) {
            return response()->json(app()->environment('local') ?
                ['error' => $exceptions->getMessage()] : ["error" => "Transport Exception"], 500);
        } elseif ($exceptions instanceof ModelNotFoundException) {
            return response()->json(app()->environment('local') ?
                ['error' => $exceptions->getMessage()] : ["error" => "Model Not Found"], 404);
        } else if ($exceptions instanceof InvalidArgumentException) {
            return response()->json(app()->environment('local') ?
                ['error' => $exceptions->getMessage()] : ["error" => "Json Malformed exception"], 500);
        } elseif (
            $exceptions instanceof AuthorizationException
        ) {
            return response()->json(['error' => $exceptions->getMessage()], 403);
        } elseif ($exceptions instanceof AuthenticationException) {
            return response()->json(['error' => $exceptions->getMessage()], 401);
        } elseif ($exceptions instanceof RouteNotFoundException) {
            return response()->json(['error' => $exceptions->getMessage()], 404);
        }
    })->create();

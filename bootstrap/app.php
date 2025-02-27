<?php

use App\Exceptions\ApiExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

$exceptionHandler = new ApiExceptionHandler();

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
    /*
    ->withExceptions(function (Exceptions $exceptions) use ($exceptionHandler) {
        $exceptions->renderable(function (Throwable $e, Request $request) use ($exceptionHandler) {
            return $exceptionHandler->handleException($e, $request);
        });
        */
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (NotFoundHttpException $e) {
            return response()->json([
                'message' => 'The requested resource was not found'
            ], 404);
        });

    })->create();

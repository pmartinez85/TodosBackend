<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Validation\ValidationException;
use Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Class Handler
 * @package App\Exceptions
 */
class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthenticationException::class,
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        TokenMismatchException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param \Exception $exception
     *
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Exception               $exception
     *
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
        {
            if ($exception instanceof ModelNotFoundException) {
                return Response::json([
                    'error' => 'Hi ha hagut una excepció: ' . $exception->getMessage(),
                    'code' => 10,
                    'status' => 404,
                ], 404);
            }
            if ($exception instanceof IncorrectModelException) {
                return Response::json([
                    'error' => 'Hi ha hagut una excepció, model incorrecte: ' . $exception->getMessage(),
                    'code' => 11,
                    'status' => 404,
                ], 404);
            }
            if ($exception instanceof \ErrorException) {
                return Response::json([
                    'error' => 'Hi ha hagut una excepció, error: ' . $exception->getMessage(),
                    'code' => 12,
                    'status' => 404,
                ], 404);
            }
            if ($exception instanceof HttpException) {
                return Response::json([
                    'error'  => 'Hi ha hagut una excepció.'.$exception->getMessage(),
                    'code'   => 13,
                    'status' => 404,
                ], 404);
            }
            return parent::render($request, $exception);
        }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     *
     * @internal param AuthenticationException $exception
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json( ['error' => 'Unauthenticated.'], 401);
        }

        return redirect()->guest('login');
    }
}

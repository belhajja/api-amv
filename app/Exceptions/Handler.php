<?php

namespace App\Exceptions;

use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {

        if ($exception instanceof \Spatie\Permission\Exceptions\UnauthorizedException) {
           
            return response()->json(['error' => 'You do not have the required authorization.'], 403);
        }
        elseif ($exception instanceof TokenInvalidException) {
            
            return response()->json(['error' => 'Token is Invalid'], 401);
        }
        elseif ($exception instanceof TokenExpiredException ) {
            
            return response()->json(['error' => 'Token Expired'], 401);
        }
        elseif ($exception instanceof JWTException ) {
            
            return response()->json(['error' => 'There\'s something wrong with your Token'], 401);
        }

        return parent::render($request, $exception);
    }
}

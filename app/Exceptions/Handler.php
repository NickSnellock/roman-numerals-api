<?php
declare(strict_types=1);

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use InvalidArgumentException;
use Symfony\Component\HttpFoundation\Response;
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
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    public function render($request, Throwable $exception) {
        if ($exception instanceof InvalidConversionValue || $exception instanceof InvalidArgumentException) {
            return response()->json(
                [
                    'error' => $exception->getMessage()
                ], Response::HTTP_BAD_REQUEST
            );
        }

        return response()->json(
            [$exception->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR
        );
    }
}

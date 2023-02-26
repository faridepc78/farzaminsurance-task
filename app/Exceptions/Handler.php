<?php

namespace App\Exceptions;

use Lanin\Laravel\ApiExceptions\ApiException;
use Lanin\Laravel\ApiExceptions\LaravelExceptionHandler;
use Throwable;

class Handler extends LaravelExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
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
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Format error message for API response.
     *
     * @param ApiException $exception
     * @return array
     */
    protected function formatApiResponse(ApiException $exception): array
    {
        return [
            'error' => $exception->toArray(),
        ];
    }
}

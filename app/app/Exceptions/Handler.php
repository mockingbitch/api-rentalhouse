<?php

namespace App\Exceptions;

use App\Core\Logger\Log;
use App\Enum\ErrorCodes;
use App\Traits\ApiResponse;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use SebastianBergmann\Invoker\TimeoutException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    use ApiResponse;
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  Request  $request
     * @param Throwable $e
     * @return Response
     *
     * @throws Throwable
     */
    public function render($request, Throwable $e): Response
    {
        if (env('APP_ENV') == 'local') :
            Log::error('Exception', $e);
        endif;

        // Method not allow exception
        if ($e instanceof MethodNotAllowedHttpException) :
            $headers = $e->getHeaders();
            $allow = $headers['Allow'];

            return $this->failureProxy(
                ErrorCodes::METHOD_NOT_ALLOWED,
                __('message.method_not_allow', ['method' => $allow])
            );
        endif;
        // Local env render
        if (!$request->is('api/*')) :
            return parent::render($request, $e);
        endif;

        // Api exception render with context
        if ($e instanceof ApiException) :
            return $this->failure(
                $e->getErrorCode(),
                $e->getMessage(),
                appends: $e->getContext()
            );
        endif;

        if ($e instanceof NotFoundHttpException) :
            return $this->failureProxy(
                ErrorCodes::NOT_FOUND,
                __('message.error.not_found')
            );
        endif;

        // Auth exception render
        if (
            $e instanceof AuthenticationException
            || $e instanceof \Laravel\Passport\Exceptions\OAuthServerException
        ) :
            return $this->failure(
                ErrorCodes::USER_UNAUTHORIZED,
                'Your request was made with invalid credentials.'
            );
        endif;

        if ($e instanceof ValidationException) :
            return $this->failure(
                ErrorCodes::REQUEST_VALIDATION_ERROR,
                "Request validation failed", $e->errors()
            );
        endif;

        if ($e instanceof TimeoutException) :
            return $this->failure(
                ErrorCodes::GATEWAY_TIME_OUT,
                "Gateway time out"
            );
        endif;

        if (env('APP_ENV') == 'local') :
            throw $e;
        endif;

        // Other exception render
        return $this->failure(
            ErrorCodes::SYSTEM_ERROR,
            'An internal server error occurred.',
            []
        );
    }
}

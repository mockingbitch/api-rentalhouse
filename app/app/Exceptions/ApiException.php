<?php

namespace App\Exceptions;

use App\Enum\ErrorCodes;
use App\Traits\ApiResponse;
use Exception;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class ApiException extends Exception
{
    use ApiResponse;

    /**
     * Error array
     *
     * @var array|string
     */
    public array|string $errors = [];

    /**
     * Context array
     *
     * @var array
     */
    public array $context = [];

    public array $errorCode = [];

    /**
     * Exception construct
     *
     * @param array $errorCode
     * @param string $message
     * @param array|string $error
     * @param array $context
     */
    public function __construct(array $errorCode, string $message = 'Api error', $error = [], array $context = [])
    {
        parent::__construct($message, $errorCode[1]);

        $this->errors = $error;
        $this->context = $context;
        $this->errorCode = $errorCode;
    }

    /**
     * Get code
     *
     * @return array
     */
    public function getErrorCode(): array
    {
        return $this->errorCode;
    }

    /**
     * Get error status
     *
     * @return int
     */
    public function getErrorStatus(): int
    {
        return $this->errorCode ? $this->errorCode[1] : ResponseAlias::HTTP_INTERNAL_SERVER_ERROR;
    }

    /**
     * Get error status
     *
     */
    public function getName()
    {
        return $this->errorCode ? $this->errorCode[0] : ErrorCodes::SYSTEM_ERROR[0];
    }

    /**
     * get api context
     *
     * @return array
     */
    public function getContext(): array
    {
        return $this->context;
    }
}

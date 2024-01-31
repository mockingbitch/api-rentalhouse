<?php

namespace App\Traits;

use App\Enum\ErrorCodes;
use App\Core\Logger\Log;
use Exception;
use Illuminate\Http\JsonResponse;

trait ApiResponse
{
    /**
     * API response success
     *
     * @param array $data
     * @param bool $logFlag
     * @param int $status
     * @return JsonResponse
     * @throws Exception
     */
    protected function success(
        array $data = [],
        bool $logFlag = true,
        int $status = 200
    ): JsonResponse
    {
        if ($logFlag) :
            Log::info('info', json_encode($data));
        endif;

        return response()->json($data, $status);
    }

    /**
     * API response success without data
     *
     * @param string $message
     * @param int $status
     * @return JsonResponse
     */
    protected function successWithoutData(string $message, int $status = 200): JsonResponse
    {
        return response()->json([
            'status' => true,
            'message' => $message
        ], $status);
    }

    /**
     * Failure
     * @param $errorCode
     * @param string $message
     * @param array|null $error
     * @param array $appends
     * @return JsonResponse
     * @throws Exception
     */
    protected function failure(
        $errorCode,
        string $message,
        array $error = null,
        array $appends = []
    ): JsonResponse
    {
        try {
            $response = [
                'name'      => $errorCode[0],
                'message'   => $message,
                'status'    => $errorCode[1],
            ];

            if (isset($errorCode[2])) :
                $response['code'] = $errorCode[2];
            endif;

            if (!empty($error)) :
                $response['fields'] = $error;
            endif;

            if (!empty($appends)) :
                $response = $response + $appends;
            endif;
            Log::error('api_error', json_encode($response, true));

            return response()->json([
                'error' => $response,
            ], $errorCode[1]);
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    /**
     * Failure Proxy
     * @param $errorCode
     * @param string $message
     * @return JsonResponse
     */
    protected function failureProxy($errorCode, string $message): JsonResponse
    {
        $response = [
            'name'      => $errorCode[0],
            'message'   => $message,
            'code'      => 0,
            'status'    => $errorCode[1],
        ];

        return response()->json([
            'error' => $response,
        ], $errorCode[1]);
    }

    /**
     * Fail Exception
     * @param Exception $exception
     * @param bool $logFlag
     * @param array $errorCode
     * @return JsonResponse
     * @throws Exception
     */
    public function exception(
        Exception $exception,
        bool $logFlag = false,
        array $errorCode = ErrorCodes::REQUEST_BAD_REQUEST
    ): JsonResponse
    {
        $message = [
            'information'   => $exception->getMessage(),
            'file'          => $exception->getFile(),
            'line'          => $exception->getLine(),
        ];
        if ($logFlag) :
            Log::error('error', json_encode($message, true));
        endif;
        $response = [
            'name'      => $errorCode[0],
            'message'   => env('APP_ENV') == 'local' ? $message : $errorCode[0],
            'status'    => $errorCode[1],
        ];

        return response()->json([
            'error' => $response,
        ], $errorCode[1]);
    }

    public function error()
    {

    }
}

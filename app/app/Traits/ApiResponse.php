<?php

namespace App\Traits;

use App\Core\Logging\Log;
use Illuminate\Http\JsonResponse;

trait ApiResponse
{
    /**
     * API response success
     *
     * @param array $data
     * @param int $status
     * @return JsonResponse
     */
    protected function success(array $data = [], int $status = 200): JsonResponse
    {
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
     * @param $errorCode
     * @param string $message
     * @param array|null $error
     * @return JsonResponse
     * @throws \Exception
     */
    protected function failure($errorCode, string $message, array $error = null, array $appends = []): JsonResponse
    {
        $log = app(Log::class);
        try {
            // For verify address
            if(isset($error['Address is invalid'])){
                $error = 'Address is invalid';
            }
            $response = [
                'name' => $errorCode[0],
                'message' => $message,
                'status' => $errorCode[1],
                'log_id'=> (!empty($log)) ? (int)$log->row_id : 0
            ];

            if (isset($errorCode[2])) {
                $response['code'] = $errorCode[2];
            }

            if (!empty($error)) {
                $response['fields'] = $error;
            }

            if (!empty($appends)) {
                $response = $response + $appends;
            }
            \App\Core\Logging\Log::append('Response', $response);
            \App\Core\Logging\Log::setMode();
            \App\Core\Logging\Log::send();
            return response()->json([
                'error' => $response,
            ], $errorCode[1]);
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    /**
     * @param $errorCode
     * @param string $message
     * @return JsonResponse
     */
    protected function failureProxy($errorCode, string $message): JsonResponse
    {
        $response = [
            'name' => $errorCode[0],
            'message' => $message,
            "code"=> 0,
            'status' => $errorCode[1],
        ];
        return response()->json([
            'error' => $response,
        ], $errorCode[1]);
    }
}

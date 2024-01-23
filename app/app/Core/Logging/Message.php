<?php

namespace App\Core\Logging;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Throwable;

class Message implements MessageInterface
{
    /**
     * @var array
     */
    protected array $data;

    /**
     * Constructor
     *
     * @param Throwable $exception
     * @param $statusCode
     * @param $message
     */
    public function __construct(Throwable $exception, $statusCode, $message = '')
    {
        $route = str_replace(
            array_filter([$_SERVER['QUERY_STRING'] ?? null, '?']),
            '',
            $_SERVER['REQUEST_URI'] ?? ''
        );
        $log = app(Log::class);
        $endAt = Carbon::now();
        $elapsedTime = $endAt->diffInMilliseconds($log->start_at);
        if ($statusCode !== 200) {
            $error = 'File: ' . $exception->getFile() . ' Line: ' . $exception->getLine() . ' Message: ' .
                substr($exception->getMessage(), 0, 1000);
        }
        $this->data = [
            'trace_id'      => $log->trace_id,
            'parent_id'     => $log->parent_id,
            'app'           => env('APP_NAME') ?? 'rentalhouse_auth',
            'uri'           => $_SERVER['REQUEST_URI'] ?? '',
            'method'        => $_SERVER['REQUEST_METHOD'] ?? 'CLI',
            'route'         => $route,
            'query'         => $_SERVER['QUERY_STRING'] ?? '',
            'message'       => $message,
            'status_code'   => $statusCode,
            'error'         => $error ?? substr($exception->getMessage(), 0, 1000),
            'user_id'       => Auth::get()['id'] ?? 0,
            'ip'            => $_SERVER['REMOTE_ADDR'] ?? 'CLI',
            'environment'   => env('APP_ENV'),
            'version'       => env('VERSION') ?? 'test',
            '@timestamp'    => $endAt->format('c'),
            'created_at'    => $endAt->format('Y-m-d h:i:s'),
            'elapsed'       => $elapsedTime/1000,
            'timezone'      => $endAt->timezone,
        ];
    }

    /**
     * To Array
     *
     * @return string[]
     */
    public function toArray(): array
    {
        if (empty($this->data)) {
            return [
                'message' => 'Message data is empty.'
            ];
        }
        return json_decode(json_encode($this->data), true);
    }
}

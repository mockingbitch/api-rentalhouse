<?php

namespace App\Core\Logging;

use App\Util\Common;
use Carbon\Carbon;
use function Nette\Utils\first;

class AwsLambdaMessage implements MessageInterface
{
    public array $data;

    public function __construct($data)
    {
        $log = app(Log::class);
        $endTime = Carbon::now();
        $elapsedTime = $endTime->diffInMilliseconds($log->start_time);
        $messagePayload = [
            'row_id' => [
                'N' => (string)$log->row_id,
            ],
            'sort_key' => [
                'S' => (string)$log->row_id,
            ],
            'created_datetime' => [
                'N' => $endTime->format('Uv')
            ],
            'app' => [
                'S' => (string)(env('APP_NAME') ?? 'gori_v2_api')
            ],
            'uri' => [
                'S' => (request()->getRequestUri() ?? '')
            ],
            'method' => [
                'S' => (request()->getMethod() ?? 'CLI')
            ],
            'route' => [
                'S' => request()->path()
            ],
            'route_name' => [
                'S' =>  (string)(request()->route() ? request()->route()->getName() : '')
            ],
            'query' => [
                'S' => (string)request()->getQueryString()
            ],
            'body' => [
                'S' => (string) json_encode(request()->all())
            ],
            'header' => [
                'S' => (string) json_encode(request()->header())
            ],
            'user_id' => [
                'N' =>  (!empty(auth()->id())) ? (string)auth()->id() : "0",
            ],
            'ip' => [
                'S' => (request()->getClientIp() ?? 'CLI')
            ],
            'environment' => [
                'S' => (string)env('APP_ENV')
            ],
            'version' => [
                'S' => (string)(env('VERSION') ?? 'test')
            ],
            '@timestamp' => [
                'S' => $endTime->format('c')
            ],
            'created_at' => [
                'S' => $endTime->format('Y-m-d h:i:s')
            ],
            'elapsed' => [
                'S' => (string) ($elapsedTime/1000)
            ],
            'timezone' => [
                'S' => (string)json_encode($endTime->timezone, true)
            ],
            'error' => [
                'BOOL' => $log->is_error ?? false
            ]
        ];
        $messagePayload = $this->mergeTraceToPayload($messagePayload, $data);
        $this->data = $messagePayload;
    }

    public function toArray(): array
    {
        if (empty($this->data)) {
            return [
                'message' => 'Message data is empty.'
            ];
        }
        return json_decode(json_encode($this->data), true);
    }

    private function mergeTraceToPayload(array $messagePayload, $data)
    {
        foreach ($data as $index => $log) {
            $messagePayload[$index] = [
                'S' => json_encode($log)
            ];
        }

        return $messagePayload;
    }
}

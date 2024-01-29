<?php

namespace App\Core\Logging;

use Illuminate\Support\Facades\DB;
use Throwable;

class Log
{
    const RUNNING = 0;
    const SUCCESS = 1;
    const FAIL = 2;

    /**
     * @var DriverInterface
     */
    public DriverInterface $driver;

    /**
     * @var string|null
     */
    public string|null $row_id = null;

    /**
     * Constructor
     *
     * @param DriverInterface $driver
     * @param $data
     * @param $rowId
     */
    public function __construct(DriverInterface $driver, $data, $rowId)
    {
        $this->driver = $driver;
        $this->row_id = $rowId;

        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }
    }

    /**
     * @param $key
     * @param array|string $information
     * @param Throwable|null $throwable
     * @return void
     */
    public static function append($key, array|string $information, Throwable $throwable = null): void
    {
//        if (Helper::isLogEnabled()) {
            $log = app(self::class);
            $log->message_data[strtolower($key)][] = $information;

            if ($throwable != null) {
                $log->message_data[strtolower($key . '_' . 'exception' . '_' . time())] = [
                    'Message'   => $throwable->getMessage(),
                    'Trace'     => $throwable->getTraceAsString(),
                    'Code'      => $throwable->getCode(),
                    'File'      => $throwable->getFile(),
                    'Line'      => $throwable->getLine(),
                    'Previous'  => $throwable->getPrevious()
                ];
            }
            app()->singleton(Log::class, function () use ($log) {
                return $log;
            });
//        }
    }

    /**
     * Set mode request is success or error
     *
     * @param bool $isError
     * @return void
     */
    public static function setMode(bool $isError = true): void
    {
        $log = app(self::class);
        $log->is_error = $isError;
    }

    /**
     * Send
     *
     * @return void
     */
    public static function send(): void
    {
//        if (Helper::isLogEnabled()) {
            $log = app(self::class);
            $logStatus = Log::SUCCESS;
            if ($log->is_error) {
                $logStatus = Log::FAIL;
            }
            $message = new AwsLambdaMessage($log->message_data ?? []);
            if (env('APP_ENV') != 'local') {
                $log = app(self::class);
                $log->driver->push($message);
            }
            DB::table('logs')->where('id', $log->row_id)->update([
                'user_id' => auth()->id(),
                'message' => json_encode($log->message_data['exception'] ?? []),
                'status' => $logStatus,
            ]);
//        }
    }
}

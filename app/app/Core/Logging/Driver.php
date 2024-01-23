<?php

namespace App\Core\Logging;

use App\Events\LogEvent;
use App\Events\AlertEvent;

class Driver implements DriverInterface
{
    const HOST_US = 'listener.logz.io';

    /** @var string */
    private string $endpoint;

    /**
     * Constructor
     *
     * @param $token
     * @param string $type
     * @param bool $ssl
     * @param string $host
     */
    public function __construct(
        $token,
        string $type = 'http-bulk',
        bool $ssl = true,
        string $host = self::HOST_US
    )
    {
        $this->endpoint = $ssl
            ? "https://$host:8071/?token=$token&type=$type"
            : "http://$host:8070/?token=$token&type=$type";
    }

    /**
     * Push
     *
     * @param Message $message
     * @return void
     */
    public function push(Message $message): void
    {
        $messageData = $message->toArray();
        if ($this->isAlert($messageData)) {
            event(new AlertEvent($messageData));
        }
        event(new LogEvent($this->endpoint, $messageData));
    }

    /**
     * Is Alert
     *
     * @param array $messageData
     * @return bool
     */
    private function isAlert(array $messageData): bool
    {
        $prefixCode = ((string)$messageData['status_code'])[0];
        return isset($messageData['status_code'])
            && in_array($prefixCode, [5, 0])
            && !in_array($messageData['environment'], ['local', 'testing'])
            ;
    }
}

<?php

namespace App\Core\Logging;

use App\Events\LogEvent;

class AwsLambdaDriver implements DriverInterface
{
    /**
     * @var String
     */
    private String $endpoint;

    /**
     * @var String
     */
    private String $apiKey;

    public function __construct(string $endpoint, string $apiKey)
    {
        $this->endpoint = $endpoint;
        $this->apiKey = $apiKey;
    }

    public function push(MessageInterface $message): void
    {
        $messageData = $message->toArray();
        event(new LogEvent($this->endpoint, $messageData, $this->apiKey));
    }
}

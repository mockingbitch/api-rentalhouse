<?php

namespace App\Events;

class LogEvent extends Event
{
    /**
     * Create a new event instance.
     *
     * @param string $endpoint
     * @param $logData
     * @param string|null $token
     */
    public string $endpoint;
    public array $logData;
    public ?string $token = null;

    /**
     * Constructor
     *
     * @param string $endpoint
     * @param array $logData
     * @param string|null $token
     */
    public function __construct(string $endpoint, array $logData, string $token = null)
    {
        $this->endpoint = $endpoint;
        $this->logData  = $logData;
        $this->token    = $token;
    }
}

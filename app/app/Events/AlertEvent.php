<?php

namespace App\Events;

class AlertEvent extends Event
{
    public $logData;

    /**
     * Create a new event instance.
     *
     * @param $logData
     */
    public function __construct($logData)
    {
        $this->logData = $logData;
    }
}

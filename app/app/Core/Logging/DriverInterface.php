<?php

namespace App\Core\Logging;

interface DriverInterface
{
    public function push(Message $message): void;
}

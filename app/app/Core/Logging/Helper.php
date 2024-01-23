<?php

namespace App\Core\Logging;

class Helper
{
    /**
     * Is Log Enabled
     *
     * @return bool
     */
    public static function isLogEnabled(): bool
    {
        return (
            !app()->runningInConsole()
            && !in_array(
                $_SERVER['REQUEST_URI'],
                explode(',', env('LOG_EXCLUDE_ROUTES', ''))
            )
        );
    }
}

<?php

namespace App\Core\Logging;

use Carbon\Carbon;

class GenerateHelper
{
    const CHARACTERS_STORAGE = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    public static function generateTraceId(): string
    {
        $randomString = array_rand(array_flip(str_split(self::CHARACTERS_STORAGE)), 16);
        return Carbon::now()->format('Uv') . '-' . implode('', $randomString);
    }

    public static function generateRowId(): string
    {
        return Carbon::now()->format('Uv');
    }
}

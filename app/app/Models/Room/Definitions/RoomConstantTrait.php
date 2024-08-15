<?php

namespace App\Models\Room\Definitions;

/**
 * Room
 *
 * @package App\Models\Room\Definitions
 * @copyright Copyright (c) 2024, jarvis.phongtran
 * @author Phong <jarvis.phongtran@gmail.com>
 */
trait RoomConstantTrait
{
    /**
     * @var array|string[] $status
     */
    private static array $status = [
        self::STATUS_INACTIVATE => 'inactive',
        self::STATUS_DRAFT      => 'draft',
        self::STATUS_PENDING    => 'pending',
        self::STATUS_APPROVED   => 'approved',
    ];

    /**
     * Get status by code
     *
     * @param $code
     * @return string
     */
    public static function getStatusByCode($code): string
    {
        return self::$status[$code] ?? '';
    }

    /**
     * Get status by key
     *
     * @param $key
     * @return string
     */
    public static function getStatusByKey($key): string
    {
        return array_flip(self::$status)[$key] ?? '';
    }
}

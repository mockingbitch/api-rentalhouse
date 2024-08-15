<?php

namespace App\Models\House\Definitions;

/**
 * House
 *
 * @package App\Models\House\Definitions
 * @copyright Copyright (c) 2024, jarvis.phongtran
 * @author Phong <jarvis.phongtran@gmail.com>
 */
trait HouseConstantTrait
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

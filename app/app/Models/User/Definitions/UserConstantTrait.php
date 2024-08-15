<?php

namespace App\Models\User\Definitions;

/**
 * User
 *
 * @package App\Models\User\Definitions
 * @copyright Copyright (c) 2024, jarvis.phongtran
 * @author Phong <jarvis.phongtran@gmail.com>
 */
trait UserConstantTrait
{
    /**
     * @var array|string[] $role
     */
    private static array $role = [
        self::ROLE_ROOT    => 'root',
        self::ROLE_ADMIN   => 'administrator',
        self::ROLE_MANAGER => 'manager',
        self::ROLE_LESSOR  => 'lessor',
        self::ROLE_LESSEE  => 'lessee',
    ];

    /**
     * Get role by code
     *
     * @param int|null $code
     * @return string
     */
    public static function getRoleByCode(?int $code): string
    {
        return self::$role[$code] ?? '';
    }

    /**
     * Get role by key
     *
     * @param string|null $key
     * @return string
     */
    public static function getRoleByKey(?string $key = ''): string
    {
        return array_flip(self::$role)[$key] ?? '';
    }

    /**
     * @var array|string[] $status
     */
    private static array $status = [
        self::STATUS_ACTIVE   => 'active',
        self::STATUS_INACTIVE => 'inactive',
    ];

    /**
     * Get status by code
     *
     * @param int|null $code
     * @return string
     */
    public static function getStatusByCode(?int $code): string
    {
        return self::$status[$code] ?? '';
    }
}

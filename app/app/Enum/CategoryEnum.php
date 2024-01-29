<?php

namespace App\Enum;

enum CategoryEnum
{
    public const MSG_NOT_FOUND      = 'Category not found';
    public const STATUS             = 'status';
    public const STATUS_DEACTIVATE  = 0;
    public const STATUS_ACTIVATE    = 1;

    public const TYPE = [
        self::STATUS_DEACTIVATE   => 'hide',
        self::STATUS_ACTIVATE     => 'display',
    ];
}

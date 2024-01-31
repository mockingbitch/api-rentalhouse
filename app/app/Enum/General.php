<?php

namespace App\Enum;

enum General
{
    public const ROLE_ADMIN   = 0;
    public const ROLE_MANAGER = 2;
    public const ROLE_LESSOR  = 4;
    public const ROLE_LESSEE  = 10;

    public const STATUS_ACTIVE    = 1;
    public const STATUS_INACTIVE  = 0;

    public const SORT_ASC  = 'ASC';
    public const SORT_DESC = 'DESC';

    public const DATE_TIME_FORMAT = 'Y-m-d H:i:s';
}

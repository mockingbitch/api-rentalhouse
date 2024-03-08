<?php

namespace App\Enum;

enum General
{
    public const ROLE_ADMIN   = 0;
    public const ROLE_MANAGER = 2;
    public const ROLE_LESSOR  = 4;
    public const ROLE_LESSEE  = 10;

    public const STATUS_INACTIVE    = 0;
    public const STATUS_DRAFT       = 1;
    public const STATUS_PENDING     = 2;
    public const STATUS_ACTIVE      = 3;


    public const SORT_ASC  = 'ASC';
    public const SORT_DESC = 'DESC';

    public const DATE_TIME_FORMAT = 'Y-m-d H:i:s';

    public const REQUEST_METHOD_SAVE  = 'save';
    public const REQUEST_METHOD_DRAFT = 'draft';
}

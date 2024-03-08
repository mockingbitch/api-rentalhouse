<?php

namespace App\Enum;

enum HouseEnum: string
{
    case FILE_PATH = 'public/houses';

    public const STATUS_INACTIVATE  = 0;
    public const STATUS_DRAFT       = 1;
    public const STATUS_PENDING     = 2;
    public const STATUS_APPROVED    = 3;
}

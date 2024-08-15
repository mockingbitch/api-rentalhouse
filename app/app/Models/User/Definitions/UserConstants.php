<?php

namespace App\Models\User\Definitions;

/**
 * User
 *
 * @package App\Models\User\Definitions
 * @copyright Copyright (c) 2024, jarvis.phongtran
 * @author Phong <jarvis.phongtran@gmail.com>
 */
interface UserConstants
{
    public const ROLE_ROOT = -1;
    public const ROLE_ADMIN   = 0;
    public const ROLE_MANAGER = 2;
    public const ROLE_LESSOR  = 4;
    public const ROLE_LESSEE  = 10;

    public const STATUS_INACTIVE    = 0;
    public const STATUS_ACTIVE      = 1;

}

<?php

namespace App\Models\House\Definitions;

/**
 * House
 *
 * @package App\Models\House\Definitions
 * @copyright Copyright (c) 2024, jarvis.phongtran
 * @author Phong <jarvis.phongtran@gmail.com>
 */
interface HouseConstants
{
    public const FILE_PATH = 'public/houses';

    public const STATUS_INACTIVATE = 0;
    public const STATUS_DRAFT      = 1;
    public const STATUS_PENDING    = 2;
    public const STATUS_APPROVED   = 3;
}

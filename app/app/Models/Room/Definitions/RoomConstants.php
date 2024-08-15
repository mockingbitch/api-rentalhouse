<?php

namespace App\Models\Room\Definitions;

/**
 * Room
 *
 * @package App\Models\Room\Definitions
 * @copyright Copyright (c) 2024, jarvis.phongtran
 * @author Phong <jarvis.phongtran@gmail.com>
 */
interface RoomConstants
{
    public const FILE_PATH = 'public/Rooms';

    public const STATUS_INACTIVATE = 0;
    public const STATUS_DRAFT      = 1;
    public const STATUS_PENDING    = 2;
    public const STATUS_APPROVED   = 3;
}

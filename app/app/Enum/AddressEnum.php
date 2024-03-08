<?php

namespace App\Enum;

enum AddressEnum: string
{
    case PROVINCE_CODE  = 'province_code';
    case DISTRICT_CODE  = 'district_code';
    case WARD_CODE      = 'ward_code';
}

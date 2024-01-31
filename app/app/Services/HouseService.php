<?php

namespace App\Services;

use App\Contracts\Repositories\HouseRepositoryInterface;

class HouseService extends BaseService
{
    /**
     * Constructor
     * @param HouseRepositoryInterface $houseRepository
     */
    public function __construct(
        protected HouseRepositoryInterface $houseRepository,
    )
    {
    }
}

<?php

namespace App\Repositories;

use App\Contracts\Repositories\HouseRepositoryInterface;
use App\Models\House;

class HouseRepository extends BaseRepository implements HouseRepositoryInterface
{
    /**
     * Get model
     *
     * @return string
     */
    public function getModel(): string
    {
        return House::class;
    }
}

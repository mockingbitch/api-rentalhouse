<?php

namespace App\Repositories;

use App\Contracts\Repositories\UserRepositoryInterface;
use App\Models\User\User;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     * Get model
     *
     * @return string
     */
    public function getModel(): string
    {
        return User::class;
    }
}

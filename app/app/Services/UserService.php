<?php

namespace App\Services;

use App\Contracts\Repositories\UserRepositoryInterface;

class UserService extends BaseService
{
    /**
     * Constructor
     *
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(
        protected UserRepositoryInterface $userRepository
    )
    {
        $this->repository = $this->userRepository;
    }
}

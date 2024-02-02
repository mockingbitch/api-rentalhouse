<?php

namespace App\Services;

use App\Contracts\Repositories\CategoryRepositoryInterface;

class CategoryService extends BaseService
{
    /**
     * Constructor
     *
     * @param CategoryRepositoryInterface $categoryRepository
     */
    public function __construct(
        protected CategoryRepositoryInterface $categoryRepository
    )
    {
        $this->repository = $this->categoryRepository;
    }
}

<?php

namespace App\Repositories;

use App\Contracts\Repositories\CategoryRepositoryInterface;
use App\Models\Category\Category;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    /**
     * Get model
     *
     * @return string
     */
    public function getModel(): string
    {
        return Category::class;
    }
}

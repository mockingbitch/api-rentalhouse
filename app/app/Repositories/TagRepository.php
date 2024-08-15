<?php

namespace App\Repositories;

use App\Contracts\Repositories\TagRepositoryInterface;
use App\Models\Tag\Tag;

class TagRepository extends BaseRepository implements TagRepositoryInterface
{
    /**
     * Get model
     *
     * @return string
     */
    public function getModel(): string
    {
        return Tag::class;
    }
}

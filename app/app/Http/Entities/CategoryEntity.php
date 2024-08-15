<?php

namespace App\Http\Entities;

use App\Models\Category\Category;

class CategoryEntity
{
    /**
     * @var int|null $id
     */
    public ?int $id;

    /**
     * @var string|null $name_vi
     */
    public ?string $name_vi;

    /**
     * @var string|null $name_en
     */
    public ?string $name_en;

    /**
     * @var string|null $description_vi
     */
    public ?string $description_vi;

    /**
     * @var string|null $description_en
     */
    public ?string $description_en;

    /**
     * @var string|null $icon
     */
    public ?string $icon;

    /**
     * @var string|null $status
     */
    public ?string $status;

    /**
     * Constructor
     *
     * @param Category|null $category
     * @param bool $isFull
     */
    public function __construct(?Category $category, bool $isFull = false)
    {
        $this->id               = $category->id ?? null;
        $this->name_vi          = $category->name_vi ?? null;
        $this->name_en          = $category->name_en ?? null;
        $this->description_vi   = $category->description_vi ?? null;
        $this->description_en   = $category->description_en ?? null;
        if ($isFull) :
            $this->icon         = $category->icon ?? null;
        endif;
    }
}

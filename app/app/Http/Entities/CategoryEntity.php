<?php

namespace App\Http\Entities;

use App\Models\Category;

class CategoryEntity
{
    /**
     * @var string|null $id
     */
    public ?string $id;

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
     */
    public function __construct(?Category $category)
    {
        $this->id               = $category->id ?? null;
        $this->name_vi          = $category->name_vi ?? null;
        $this->name_en          = $category->name_en ?? null;
        $this->description_vi   = $category->description_vi ?? null;
        $this->description_en   = $category->description_en ?? null;
        $this->icon             = $category->icon ?? null;
    }
}

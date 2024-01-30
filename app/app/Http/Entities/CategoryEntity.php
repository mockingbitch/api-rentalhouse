<?php

namespace App\Http\Entities;

class CategoryEntity
{
    /**
     * @var string
     */
    public string $name_vi;

    /**
     * @var string
     */
    public string $name_en;

    /**
     * @var string|null
     */
    public ?string $description_vi;

    /**
     * @var string|null
     */
    public ?string $description_en;

    /**
     * @var string
     */
    public string $icon;

    /**
     * @var string|null
     */
    public ?string $status;

    /**
     * Constructor
     * @param array $params
     */
    public function __construct(array $params = [])
    {
        $this->name_vi          = $params['name_vi'];
        $this->name_en          = $params['name_en'];
        $this->description_vi   = $params['description_vi'];
        $this->description_en   = $params['description_en'];
        $this->icon             = $params['icon'];
    }
}

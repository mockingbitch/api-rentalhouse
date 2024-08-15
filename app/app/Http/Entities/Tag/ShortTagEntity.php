<?php

namespace App\Http\Entities\Tag;

use App\Models\Tag\Tag;

class ShortTagEntity
{
    /**
     * @var string|null
     */
    public ?string $id;

    /**
     * @var string|null
     */
    public ?string $name_vi;

    /**
     * @var string|null
     */
    public ?string $name_en;

    /**
     * Constructor
     *
     * @param Tag $tag
     */
    public function __construct(Tag $tag)
    {
        $this->id           = $tag->id ?? null;
        $this->name_vi      = $tag->name_vi ?? null;
        $this->name_en      = $tag->name_en ?? null;
    }
}

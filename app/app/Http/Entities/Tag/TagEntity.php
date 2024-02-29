<?php

namespace App\Http\Entities\Tag;

use App\Models\Tag;

class TagEntity
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
     * @var string|null  $status
     */
    public ?string $status;

    /**
     * @var string|null $created_by
     */
    public ?string $created_by;

    /**
     * @var string|null $updated_by
     */
    public ?string $updated_by;

    /**
     * @var string|null $deleted_by
     */
    public ?string $deleted_by;

    /**
     * @var string|null $created_at
     */
    public ?string $created_at;

    /**
     * @var string|null $updated_at
     */
    public ?string $updated_at;

    /**
     * @var string|null $deleted_at
     */
    public ?string $deleted_at;

    /**
     * Constructor
     *
     * @param Tag $tag
     * @param bool $hasPermission
     */
    public function __construct(Tag $tag, bool $hasPermission = false)
    {
        $this->id           = $tag->id ?? null;
        $this->name_vi      = $tag->name ?? null;
        $this->name_en      = $tag->house_id ?? null;
        $this->status       = $tag->status ?? null;
        if ($hasPermission) :
            $this->created_by   = $tag->created_by ?? null;
            $this->updated_by   = $tag->updated_by ?? null;
            $this->deleted_by   = $tag->deleted_by ?? null;
            $this->created_at   = $tag->created_at ?? null;
            $this->updated_at   = $tag->updated_at ?? null;
            $this->deleted_at   = $tag->deleted_at ?? null;
        endif;
    }
}

<?php

namespace App\Http\Entities;

use App\Http\Entities\Address\AddressEntity;
use App\Models\House;
use DateTime;

class HouseEntity
{
    /**
     * @var string|null
     */
    public ?string $id;

    /**
     * @var string|null
     */
    public ?string $name;

    /**
     * @var LessorEntity|null $lessor
     */
    public ?LessorEntity $lessor;

    /**
     * @var string|null
     */
    public ?string $full_name;

    /**
     * @var string|null $description
     */
    public ?string $description;

    /**
     * @var string|null $thumbnail
     */
    public ?string $thumbnail;

    /**
     * @var CategoryEntity|null $category
     */
    public ?CategoryEntity $category;

    /**
     * @var AddressEntity|null $address
     */
    public ?AddressEntity $address;

    /**
     * @var string|null $verified_at
     */
    public ?string $verified_at;

    /**
     * @var string|null $status
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
     * @param House $house
     * @param bool $hasPermission
     */
    public function __construct(House $house, bool $hasPermission = false)
    {
        $this->id           = $house->id ?? null;
        $this->name         = $house->name ?? null;
        $this->lessor       = new LessorEntity($house->lessor ?? null);
        $this->full_name    = $house->full_name ?? null;
        $this->description  = $house->description ?? null;
        $this->thumbnail    = $house->thumbnail ?? null;
        $this->category     = new CategoryEntity($house->category ?? null);
        $this->address      = new AddressEntity($house->address ?? [], $house->full_address ?? null);
        $this->verified_at  = $house->verified_at ?? null;
        $this->status       = $house->status ?? null;
        if ($hasPermission) :
            $this->created_by   = $house->created_by ?? null;
            $this->updated_by   = $house->updated_by ?? null;
            $this->deleted_by   = $house->deleted_by ?? null;
            $this->created_at   = $house->created_at ?? null;
            $this->updated_at   = $house->updated_at ?? null;
            $this->deleted_at   = $house->deleted_at ?? null;
        endif;

    }
}

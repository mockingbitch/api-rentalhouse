<?php

namespace App\Http\Entities;

use App\Http\Entities\Address\AddressEntity;
use DateTime;

class HouseEntity
{
    /**
     * @var string
     */
    public string $id;

    /**
     * @var string|null
     */
    public ?string $name;

    /**
     * @var LessorEntity $lessor
     */
    public LessorEntity $lessor;

    /**
     * @var string
     */
    public string $full_name;

    /**
     * @var string|null $description
     */
    public ?string $description;

    /**
     * @var string|null $thumbnail
     */
    public ?string $thumbnail;

    /**
     * @var CategoryEntity
     */
    public CategoryEntity $category;

    /**
     * @var AddressEntity|null $address
     */
    public ?AddressEntity $address;

    /**
     * @var DateTime $verified_at
     */
    public DateTime $verified_at;

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
     * @var DateTime $created_at
     */
    public DateTime $created_at;

    /**
     * @var DateTime|null $updated_at
     */
    public ?DateTime $updated_at;

    /**
     * @var DateTime|null $deleted_at
     */
    public ?DateTime $deleted_at;

    /**
     * Constructor
     * @param array $params
     */
    public function __construct(array $params = [])
    {
        $this->id           = $params['id'] ?? null;
        $this->name         = $params['name'] ?? null;
        $this->lessor       = $params['lessor'] ?? null;
        $this->full_name    = $params['full_name'] ?? null;
        $this->description  = $params['description'] ?? null;
        $this->thumbnail    = $params['thumbnail'] ?? null;
        $this->category     = $params['category'] ?? null;
        $this->address      = $params['address'] ?? null;
        $this->verified_at  = $params['verified_at'] ?? null;
        $this->status       = $params['status'] ?? null;
        $this->created_by   = $params['created_by'] ?? null;
        $this->updated_by   = $params['updated_by'] ?? null;
        $this->deleted_by   = $params['deleted_by'] ?? null;
        $this->created_at   = $params['created_at'] ?? null;
        $this->updated_at   = $params['updated_at'] ?? null;
        $this->deleted_at   = $params['deleted_at'] ?? null;
    }
}

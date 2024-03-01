<?php

namespace App\Http\Entities\Address;

use App\Models\Address\Province;

class ProvinceEntity
{
    /**
     * @var string|null $code
     */
    public ?string $code;

    /**
     * @var string|null $name
     */
    public ?string $name;

    /**
     * @var ?string|null $name_en
     */
    public ?string $name_en;

    /**
     * @var string|null $full_name
     */
    public ?string $full_name;

    /**
     * @var string|null $full_name_en
     */
    public ?string $full_name_en;

    /**
     * Constructor
     * @param Province|null $province
     */
    public function __construct(?Province $province)
    {
        $this->code          = $province->code ?? null;
        $this->name          = $province->name ?? null;
        $this->name_en       = $province->name_en ?? null;
        $this->full_name     = $province->full_name ?? null;
        $this->full_name_en  = $province->full_name_en ?? null;
    }
}

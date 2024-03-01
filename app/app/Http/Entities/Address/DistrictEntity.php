<?php

namespace App\Http\Entities\Address;

use App\Models\Address\District;

class DistrictEntity
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
     * @var string|null $name_en
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
     * @var string|null $province_code
     */
    public ?string $province_code;

    /**
     * Constructor
     * @param District|null $district
     */
    public function __construct(?District $district)
    {
        $this->code          = $district->code ?? null;
        $this->name          = $district->name ?? null;
        $this->name_en       = $district->name_en ?? null;
        $this->full_name     = $district->full_name ?? null;
        $this->full_name_en  = $district->full_name_en ?? null;
        $this->province_code = $district->province_cod ?? null;
    }
}

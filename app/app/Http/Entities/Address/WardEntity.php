<?php

namespace App\Http\Entities\Address;

use App\Models\Address\Ward;

class WardEntity
{
    /**
     * @var string
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
     * @var string|null $district_code
     */
    public ?string $district_code;

    /**
     * Constructor
     * @param Ward $ward
     */
    public function __construct(Ward $ward)
    {
        $this->code          = $ward->code ?? null;
        $this->name          = $ward->name ?? null;
        $this->name_en       = $ward->name_en ?? null;
        $this->full_name     = $ward->full_name ?? null;
        $this->full_name_en  = $ward->full_name_en ?? null;
        $this->district_code = $ward->district_code ?? null;
    }
}

<?php

namespace App\Http\Entities\Address;

class AddressEntity
{
    /**
     * @var ProvinceEntity $province
     */
    public ProvinceEntity $province;

    /**
     * @var DistrictEntity $district
     */
    public DistrictEntity $district;

    /**
     * @var WardEntity $ward
     */
    public WardEntity $ward;

    /**
     * @var string|null $full_address
     */
    public ?string $full_address;

    /**
     * Constructor
     * @param array $params
     */
    public function __construct(array $params = [])
    {
        $this->province     = $params['province'] ?? null;
        $this->district     = $params['district'] ?? null;
        $this->ward         = $params['ward'] ?? null;
        $this->full_address = $params['full_address'] ?? null;
    }
}

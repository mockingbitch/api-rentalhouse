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
     * @param string $full_address
     */
    public function __construct(array $params = [], string $full_address = '')
    {
        $this->province     = new ProvinceEntity($params['province'] ?? []);
        $this->district     = new DistrictEntity($params['district'] ?? []);
        $this->ward         = new WardEntity($params['ward'] ?? []);
        $this->full_address = $full_address;
    }
}

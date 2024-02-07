<?php

namespace App\Http\Entities\Address;

class ProvinceEntity
{
    /**
     * @var string
     */
    public string $code;

    /**
     * @var string
     */
    public string $name;

    /**
     * @var string
     */
    public string $name_en;

    /**
     * @var string
     */
    public string $full_name;

    /**
     * @var string
     */
    public string $full_name_en;

    /**
     * Constructor
     * @param array $params
     */
    public function __construct(array $params = [])
    {
        $this->code          = $params['code'];
        $this->name          = $params['name'];
        $this->name_en       = $params['name_en'];
        $this->full_name     = $params['full_name'];
        $this->full_name_en  = $params['full_name_en'];
    }
}

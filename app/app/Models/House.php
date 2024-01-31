<?php

namespace App\Models;

class House extends BaseModel
{
    /**
     * @var array $fillable
     */
    protected $fillable = [
        'id',
        'lessor_id',
        'name',
        'description',
        'province_code',
        'district_code',
        'ward_code',
        'full_address',
        'thumbnail',
        'category_id',
        'verified_at',
        'status',
    ];
}

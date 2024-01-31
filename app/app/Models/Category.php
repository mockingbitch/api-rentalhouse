<?php

namespace App\Models;

class Category extends BaseModel
{
    /**
     * @var array $fillable
     */
    protected $fillable = [
        'name_vi',
        'name_en',
        'description_vi',
        'description_en',
        'icon',
        'status',
    ];
}

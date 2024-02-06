<?php

namespace App\Models;

class Tag extends BaseModel
{
    /**
     * @var array $fillable
     */
    protected $fillable = [
        'name_vi',
        'name_en',
        'status',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
}

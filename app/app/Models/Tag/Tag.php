<?php

namespace App\Models\Tag;

use App\Models\BaseModel;

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

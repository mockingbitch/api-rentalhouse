<?php

namespace App\Models;

use App\Constants\CategoryConstant;
use App\Enum\CategoryEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * Get Status Attribute
     * @param $value
     * @return string|null
     */
    public function getStatusAttribute($value): ?string
    {
        return match ($value) {
            CategoryEnum::STATUS_DEACTIVATE  => CategoryEnum::TYPE[CategoryEnum::STATUS_DEACTIVATE],
            CategoryEnum::STATUS_ACTIVATE    => CategoryEnum::TYPE[CategoryEnum::STATUS_ACTIVATE],
            default => null,
        };
    }
}

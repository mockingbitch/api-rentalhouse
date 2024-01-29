<?php

namespace App\Models;

use App\Constants\TagConstant;
use App\Enum\TagEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use HasFactory, SoftDeletes;

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
            TagEnum::STATUS_DEACTIVATE  => TagEnum::TYPE[TagEnum::STATUS_DEACTIVATE],
            TagEnum::STATUS_ACTIVATE    => TagEnum::TYPE[TagEnum::STATUS_ACTIVATE],
            default => null,
        };
    }
}

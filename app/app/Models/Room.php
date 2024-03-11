<?php

namespace App\Models;

use App\Casts\Json;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $house_id
 * @property string $name
 * @property string $description
 * @property string $detail
 * @property json $images
 * @property float $price
 * @property int $type
 * @property json $tags
 * @property int $status
 * @property int $approved_by
 * @property int $created_by
 * @property int $updated_by
 * @property int $deleted_by
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property string $reason_delete
 */
class Room extends BaseModel
{
    /**
     * @var array $fillable
     */
    protected $fillable = [
        'id',
        'house_id',
        'name',
        'description',
        'detail',
        'images',
        'price',
        'type',
        'tags',
        'status',
        'created_by',
        'updated_by',
        'deleted_by',
        'reason_delete',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'images' => Json::class,
        'detail' => Json::class,
        'tags'   => Json::class,
    ];

    /**
     * @return BelongsTo
     */
    public function house(): BelongsTo
    {
        return $this->belongsTo(House::class, 'id');
    }
}

<?php

namespace App\Models;

use App\Casts\Json;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'status',
        'tags',
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

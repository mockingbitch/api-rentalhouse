<?php

namespace App\Models\House;

use App\Models\Address\District;
use App\Models\Address\Province;
use App\Models\Address\Ward;
use App\Models\BaseModel;
use App\Models\Category\Category;
use App\Models\House\Definitions\HouseDefs;
use App\Models\Room\Room;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $lessor_id
 * @property string $name
 * @property string $description
 * @property string $province_code
 * @property string $district_code
 * @property string $ward_code
 * @property string $full_address
 * @property string $thumbnail
 * @property int $category_id
 * @property string $verified_at
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
        'created_by',
        'updated_by',
        'deleted_by',
        'approve_by',
        'reason_delete',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'verified_at' => 'datetime:Y-m-d H:00',
        'created_at'  => 'datetime:Y-m-d H:i:s',
        'updated_at'  => 'datetime:Y-m-d H:i:s',
        'deleted_at'  => 'datetime:Y-m-d H:i:s',
    ];

    /**
     * @return BelongsTo
     */
    public function lessor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'lessor_id');
    }

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * @return BelongsTo
     */
    public function province(): BelongsTo
    {
        return $this->belongsTo(
            Province::class,
            'province_code',
            'code'
        );
    }

    /**
     * @return BelongsTo
     */
    public function district(): BelongsTo
    {
        return $this->belongsTo(
            District::class,
            'district_code',
            'code'
        );
    }

    /**
     * @return BelongsTo
     */
    public function ward(): BelongsTo
    {
        return $this->belongsTo(
            Ward::class,
            'ward_code',
            'code'
        );
    }

    /**
     * @return HasMany
     */
    public function rooms(): HasMany
    {
        return $this->hasMany(Room::class, 'house_id');
    }

    /**
     * @var string[]
     */
    protected $appends = [
        'address',
        'status_label',
    ];

    /**
     * @return Attribute
     */
    public function address(): Attribute
    {
        $address = [
            'province'  => Province::where('code', $this->province_code)->first() ?? null,
            'district'  => District::where('code', $this->district_code)->first() ?? null,
            'ward'      => Ward::where('code', $this->ward_code)->first() ?? null,
        ];

        return Attribute::make(
            get: fn() => $address ?? []
        );
    }

    /**
     * Status label
     *
     * @return Attribute
     */
    public function statusLabel(): Attribute
    {
        return Attribute::make(
            get: fn() => __('label.common.status.' . HouseDefs::getStatusByCode($this->status))
        );
    }
}

<?php

namespace App\Models;

use App\Models\Address\District;
use App\Models\Address\Province;
use App\Models\Address\Ward;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
}

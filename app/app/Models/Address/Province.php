<?php

namespace App\Models\Address;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Province extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'provinces';

    /**
     * Unit
     * @return BelongsTo
     */
    public function unit() : BelongsTo
    {
        return $this->belongsTo(
            AdministrativeUnit::class,
            'administrative_unit_id'
        );
    }

    /**
     * Region
     * @return BelongsTo
     */
    public function region() : BelongsTo
    {
        return $this->belongsTo(
            AdministrativeRegion::class,
            'administrative_region_id'
        );
    }
}

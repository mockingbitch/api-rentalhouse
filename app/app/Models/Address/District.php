<?php

namespace App\Models\Address;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class District extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'districts';

    /**
     * Province
     * @return BelongsTo
     */
    public function province() : BelongsTo
    {
        return $this->belongsTo(
            Province::class,
            'province_code',
            'code'
        );
    }

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
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Enum\General;
use Carbon\Carbon;

class BaseModel extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that should be hidden for arrays.
     */
    protected $hidden = ['deleted_at'];

    /**
     * Get Created At Attribute
     * @param string $date
     * @return string
     */
    public function getCreatedAtAttribute(string $date): string
    {
        return Carbon::parse($date)->format(General::DATE_TIME_FORMAT);
    }

    /**
     * Get Updated At Attribute
     * @param string $date
     * @return string
     */
    public function getUpdatedAtAttribute(string $date): string
    {
        return Carbon::parse($date)->format(General::DATE_TIME_FORMAT);
    }

    /**
     * Get Verified At Attribute
     * @param string|null $date
     * @return string
     */
    public function getVerifiedAtAttribute(?string $date): string
    {
        return Carbon::parse($date)->format(General::DATE_TIME_FORMAT);
    }
}

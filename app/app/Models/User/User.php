<?php

namespace App\Models\User;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enum\General;
use App\Models\Address\District;
use App\Models\Address\Province;
use App\Models\Address\Ward;
use App\Models\User\Definitions\UserDefs;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

/**
 * App\User
 *
 * @property int $id
 * @property int $role
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * @var string[]
     */
    protected $appends = [
        'ward',
        'district',
        'province',
    ];

    /**
     * @return Attribute
     */
    public function ward(): Attribute
    {
        $ward = Ward::where('code', $this->ward_code)->first();

        return Attribute::make(
            get: fn() => $ward ? $ward->name : null
        );
    }

    /**
     * @return Attribute
     */
    public function district(): Attribute
    {
        $district = District::where('code', $this->district_code)->first();

        return Attribute::make(
            get: fn() => $district ? $district->name : null
        );
    }

    /**
     * @return Attribute
     */
    public function province(): Attribute
    {
        $province = Province::where('code', $this->province_code)->first();

        return Attribute::make(
            get: fn() => $province ? $province->name : null
        );
    }

    /**
     * Get Status Attribute
     * @param $value
     * @return string|null
     */
    public function getStatusAttribute($value): ?string
    {
        return __('label.common.status.' . UserDefs::getStatusByCode($value));
    }

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
}

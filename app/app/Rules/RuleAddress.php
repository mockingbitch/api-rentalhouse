<?php

namespace App\Rules;

use App\Enum\AddressEnum;
use App\Models\Address\District;
use App\Models\Address\Province;
use App\Models\Address\Ward;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class RuleAddress implements ValidationRule
{
    /**
     * @param string|null $parentCode
     */
    public function __construct(protected ?string $parentCode)
    {
    }

    /**
     * Run the validation rule.
     *
     * @param string $attribute
     * @param mixed $value
     * @param Closure(string): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!$this->parentCode) :
            return;
        endif;
        switch ($attribute) {
            case AddressEnum::DISTRICT_CODE->value :
                $districts = District::where('province_code', $this->parentCode)->pluck('code');
                if (!in_array($value, $districts->toArray())) :
                    $fail(__('validation.address.district.invalid'));
                endif;
                break;
            case AddressEnum::WARD_CODE->value :
                $wards = Ward::where('district_code', $this->parentCode)->pluck('code');
                if (!in_array($value, $wards->toArray())) :
                    $fail(__('validation.address.ward.invalid'));
                endif;
                break;
            default :
                break;
        }
    }
}

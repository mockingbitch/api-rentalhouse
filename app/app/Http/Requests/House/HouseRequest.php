<?php

namespace App\Http\Requests\House;

use Illuminate\Contracts\Validation\ValidationRule;
use App\Http\Requests\BaseRequest;
use App\Rules\RuleAddress;
use App\Enum\General;
use Illuminate\Validation\Rule;

/**
 * @property string $name
 * @property string $description
 * @property string $province_code
 * @property string $district_code
 * @property string $ward_code
 * @property string $full_address
 * @property string $thumbnail
 * @property string $category_id
 */
class HouseRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        if ($this->method && $this->method == General::REQUEST_METHOD_DRAFT) :
            return [
                'name'          => 'max:255',
                'description'   => 'max:255',
                'province_code' => ['exists:provinces,code', Rule::requiredIf($this->province_code || $this->district_code || $this->ward_code)],
                'district_code' => ['exists:districts,code', Rule::requiredIf($this->province_code || $this->district_code || $this->ward_code), new RuleAddress($this->province_code)],
                'ward_code'     => ['exists:wards,code', Rule::requiredIf($this->province_code || $this->district_code || $this->ward_code), new RuleAddress($this->district_code) ],
                'full_address'  => 'max:255',
                'thumbnail'     => 'image|mimes:jpg,png,jpeg|max:2048|dimensions:min_width=500,min_height=500,max_width=4000,max_height=4000',
                'category_id'   => 'exists:categories,id',
            ];
        endif;

        return [
            'name'          => 'required|max:255',
            'description'   => 'max:255',
            'province_code' => 'required|exists:provinces,code',
            'district_code' => ['required', 'exists:districts,code', new RuleAddress($this->province_code)],
            'ward_code'     => ['required', 'exists:wards,code', new RuleAddress($this->district_code) ],
            'full_address'  => 'max:255',
            'thumbnail'     => 'required|image|mimes:jpg,png,jpeg|max:2048|dimensions:min_width=500,min_height=500,max_width=4000,max_height=4000',
            'category_id'   => 'required|exists:categories,id',
        ];
    }

    /**
     * Get the attributes that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function attributes(): array
    {
        return [
            'name'          => __('label.house.field.name'),
            'description'   => __('label.house.field.description'),
            'province_code' => __('label.house.field.province_code'),
            'district_code' => __('label.house.field.district_code'),
            'ward_code'     => __('label.house.field.ward_code'),
            'full_address'  => __('label.house.field.full_address'),
            'thumbnail'     => __('label.house.field.thumbnail'),
            'category_id'   => __('label.house.field.category_id'),
        ];
    }
}

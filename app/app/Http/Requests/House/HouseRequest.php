<?php

namespace App\Http\Requests\House;

use App\Http\Requests\BaseRequest;
use Illuminate\Contracts\Validation\ValidationRule;

class HouseRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'          => 'required|max:255',
            'description'   => 'max:255',
            'province_code' => 'required|exists:provinces,code',
            'district_code' => 'required|exists:districts,code',
            'ward_code'     => 'required|exists:wards,code',
            'full_address'  => 'max:255',
            'thumbnail'     => 'required',
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

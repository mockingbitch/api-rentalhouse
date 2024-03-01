<?php

namespace App\Http\Requests\Category;

use App\Http\Requests\BaseRequest;
use Illuminate\Contracts\Validation\ValidationRule;

class CategoryRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name_vi' => 'required|max:100|unique:categories',
            'name_en' => 'required|max:100|unique:categories',
            'icon'    => 'required',
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
            'name_vi' => __('label.category.field.name_vi'),
            'name_en' => __('label.category.field.name_en'),
            'icon'    => __('label.category.field.icon')
        ];
    }
}

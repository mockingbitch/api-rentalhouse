<?php

namespace App\Http\Requests\Tag;

use App\Http\Requests\BaseRequest;
use Illuminate\Contracts\Validation\ValidationRule;

class TagRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name_vi' => 'required|max:100|unique:tags',
            'name_en' => 'required|max:100|unique:tags',
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
            'name_vi' => __('label.tag.field.name_vi'),
            'name_en' => __('label.tag.field.name_en'),
        ];
    }
}
